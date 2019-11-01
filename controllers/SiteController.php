<?php

namespace app\controllers;

use app\models\entities\Authors;
use app\models\entities\Books;
use app\models\forms\LoginForm;
use app\models\services\AuthService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
/**
 * Контроллер для вывода общедоступной информации и формы аутентификации.
 */
class SiteController extends Controller
{
    private $authService;
    public function __construct($id, $module, AuthService $authService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Вывод главной страницы.
     * @return string
     */
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find()->joinWith(Books::RELATION_AUTHORS),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Вывод подробной информации о книге.
     * @param integer $id
     * @return string
     */

    public function actionBook($id)
    {
        $modelBook = Books::find()
            ->joinWith([Books::RELATION_AUTHORS, Books::RELATION_BINDING, Books::RELATION_LANGUAGE])
            ->where(['books.id' => $id])
            ->one();
        return $this->render('book', [
            'model' => $modelBook
        ]);
    }

    /**
     * Вывод информации об авторах.
     * @return string
     */

    public function actionAuthors()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Authors::find()->joinWith(Authors::RELATION_BOOKS),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        return $this->render('authors', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Вывод подробной информации об авторе.
     * @param integer $id
     * @return string
     */

    public function actionAuthor($id)
    {
        $modelAuthor = Authors::find()->where(['authors.id' => $id])->one();
        $dataProviderBooks = new ActiveDataProvider([
            'query' => Books::find()->joinWith(Books::RELATION_AUTHORS)->where(['authors.id' => $id]),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        return $this->render('author', [
            'model' => $modelAuthor,
            'dataProviderBooks' => $dataProviderBooks
        ]);
    }

    /**
     * Форма для входа в административный раздел.
     * @return Response|string
     */

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->authService->login($form);
                return $this->goBack();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        $form->reset();
        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Выход с сайта.
     * @return Response
     */

    public function actionLogout()
    {
        $this->authService->logout();
        return $this->goHome();
    }
}
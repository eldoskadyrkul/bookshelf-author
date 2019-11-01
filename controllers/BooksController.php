<?php
namespace app\controllers;

use app\models\entities\Authors;
use app\models\entities\Bindings;
use app\models\entities\Books;
use app\models\entities\BooksAuthors;
use app\models\entities\LanguageBooks;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер для работы с моделью Books.
 */

class BooksController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'delete-authors' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Вывод списка моделей Books.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find()->innerJoinWith(Books::RELATION_LANGUAGE),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        $dataProvider->sort->attributes = array_merge(
            $dataProvider->sort->attributes,
            [
                'language.name' => [
                    'asc' => ['languages.name' => SORT_ASC],
                    'desc' => ['languages.name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Язык'
                ]
            ]
        );
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Вывод подробного описания модели Books.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionView($id)
    {
        $model = Books::find()->joinWith([Books::RELATION_AUTHORS, Books::RELATION_LANGUAGE, Books::RELATION_BINDING])
            ->byId($id)->one();
        if (!$model) {
            throw new NotFoundHttpException('Страница не найдена');
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Создание новой модели Books.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Books();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $arLanguages = LanguageBooks::find()->select('name')->indexBy('id')->column();
        $arBindings = Bindings::find()->select('name')->indexBy('id')->column();
        return $this->render('create', [
            'model' => $model,
            'languages' => $arLanguages,
            'bindings' => $arBindings,
        ]);
    }

    /**
     * Обновление информации в существующей модели Books.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $arLanguages = LanguageBooks::find()->select('name')->indexBy('id')->column();
        $arBindings = Bindings::find()->select('name')->indexBy('id')->column();
        return $this->render('update', [
            'model' => $model,
            'languages' => $arLanguages,
            'bindings' => $arBindings,
        ]);
    }

    /**
     * Связать модель Books с моделью Authors.
     * @param integer $idBook
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionAddAuthor($idBook)
    {
        $modelBook = $this->findModel($idBook);
        $model = new BooksAuthors();
        $model->book_id = $idBook;
        $arCurrentAuthor = BooksAuthors::find()->select('author_id')->where(['book_id' => $idBook])->column();
        $arAuthors = Authors::find()->select('name')->where(['NOT IN', 'id', $arCurrentAuthor])->indexBy('id')->column();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Автор добавлен');
            return $this->redirect(['books/view', 'id' => $idBook]);
        }
        return $this->render('author_add', [
            'model' => $model,
            'modelBook' => $modelBook,
            'authors' => $arAuthors
        ]);
    }

    /**
     * Удалить связь между моделью Books и моделью Authors.
     * @param $idBook
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionRemoveAuthor($idBook)
    {
        $modelBook = $this->findModel($idBook);
        $dataProvider = new ActiveDataProvider([
            'query' => BooksAuthors::find()->innerJoinWith(BooksAuthors::RELATION_AUTHOR)->where(['book_id' => $idBook]),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        $dataProvider->sort->attributes = array_merge(
            $dataProvider->sort->attributes,
            [
                'author.name' => [
                    'asc' => ['authors.name' => SORT_ASC],
                    'desc' => ['authors.name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Автор'
                ]
            ]
        );
        return $this->render('author_remove', [
            'modelBook' => $modelBook,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Удаление существующей модели Books.
     * Перед удалением проверяем, что у модели нет связей с моделью Authors.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->authors) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->session->setFlash('error', 'Есть связи с авторами! Удалите связи с ними перед удалением.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Удалить в модели BooksAuthors связи между моделями Books и Authors.
     * @param $id_book
     * @param $id_author
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */

    public function actionDeleteAuthors($id_book, $id_author)
    {
        $model = BooksAuthors::findOne(['id_book' => $id_book, 'id_author' => $id_author]);
        $model->delete();
        return $this->redirect(['remove-author', 'idBook' => $id_book]);
    }
    
    /**
     * Поиск модели Books по порвичному ключу.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Страница не найдена');
    }
}
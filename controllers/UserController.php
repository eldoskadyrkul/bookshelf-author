<?php

namespace app\controllers;

use app\models\entities\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер для работы с моделью User.
 */

class UserController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Вывод списка моделей User.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Вывод подробного описания модели User.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создание новой модели User.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new User();
        $model->setScenario(User::SCENARIO_NEW_USER);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Обновить профиль модели User.
     * Пароль обновляется в отдельном экшене.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdateProfile($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(User::SCENARIO_UPDATE_PROFILE);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update_profile', [
            'model' => $model,
        ]);
    }

    /**
     * Обновить пароль у модели User.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdatePass($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(User::SCENARIO_UPDATE_PASSWORD);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update_pass', [
            'model' => $model,
        ]);
    }

    /**
     * Удаление существующей модели.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */

    public function actionDelete($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'Нельзя удалить текущего пользователя!');
            return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Страница не найдена');
    }
}
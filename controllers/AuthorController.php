<?php

namespace app\controllers;

use app\models\entities\Authors;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AuthorController extends \yii\web\Controller
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
     * Вывод списка моделей Authors.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Authors::find(),
            'pagination' => [
                'pageSize' => Yii::$app->params['paginationSize'],
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Вывод подробного описания модели Authors.
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
     * Создание новой модели Authors.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Authors();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Автор добавлен!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Обновление информации в существующей модели Authors.
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
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Удаление существующей модели Authors.
     * Перед удалением проверяем, что у модели нет связей с моделью Books.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->books) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->session->setFlash('error', 'У автора есть книги! Удалите связи с ними перед удалением.');
        }
        return $this->redirect(['index']);
    }
    /**
     * Поиск модели Authors по порвичному ключу.
     * @param integer $id
     * @return \app\core\entities\Authors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Authors::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Страница не найдена');
    }

}

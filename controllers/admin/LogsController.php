<?php

namespace app\controllers\admin;

use Yii;
use app\models\entities\Logs;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogsController implements the CRUD actions for Logs model.
 */

class LogsController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Logs models.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Logs::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Logs model.
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
     * Finds the Logs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Logs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Logs::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
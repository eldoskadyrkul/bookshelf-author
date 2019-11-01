<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function (\app\models\entities\User $model) {
                    return Html::a($model->username, ['user/view', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (\app\models\entities\User $model) {
                    return Html::a($model->name, ['user/view', 'id' => $model->id]);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
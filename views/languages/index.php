<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


$this->title = 'Языки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="languages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить новый', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (\app\models\entities\LanguageBooks $model) {
                    return Html::a($model->name, ['languages/view', 'id' => $model->id]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
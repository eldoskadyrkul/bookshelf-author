<?php


use yii\helpers\Html;
use yii\grid\GridView;


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'ID',
            'Тип',
            'Модуль',
            'Сообщение',
            'Создан:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
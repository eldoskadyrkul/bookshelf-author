<?php


use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'Тип',
            'Модуль',
            'Сообщение',
            'Создан:datetime',
        ],
    ]) ?>

</div>
<?php


use yii\helpers\Html;


$this->title = 'Переплет: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Переплеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="bindings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
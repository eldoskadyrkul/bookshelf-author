<?php

use yii\helpers\Html;


$this->title = 'Добавить переплеты';
$this->params['breadcrumbs'][] = ['label' => 'Переплеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="bindings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
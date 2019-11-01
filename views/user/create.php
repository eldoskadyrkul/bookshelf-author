<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\core\entities\User */

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_new', [
        'model' => $model,
    ]) ?>

</div>
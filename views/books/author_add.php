<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Добавить автора';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelBook->name, 'url' => ['view', 'id' => $modelBook->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->dropDownList($authors)->label("Выберите автора для книги: {$modelBook->name}") ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
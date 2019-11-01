<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \app\core\entities\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
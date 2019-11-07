<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\core\forms\LoginForm */


$this->title = 'Вход в личный кабинет';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="container-fluid">
    <div class="row no-gutter">
        <div  class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n<div class=\"form-label-group\">{input}</div>\n<div class=\"form\">{error}</div>",
                                    'labelOptions' => ['class' => ''],
                                ],
                            ]); ?>
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>

                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "<div class=\"custom-control custom-checkbox mb-3\">{input} {label}</div>\n<div class=\"form-label-group\">{error}</div>",
                            ]) ?>

                            <?= Html::submitButton('Войти', ['class' => 'btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2', 'name' => 'login-button']) ?>
                            <?php ActiveForm::end(); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
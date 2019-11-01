<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \app\core\entities\Books */

$name = Html::encode($model->name);
$arAuthors = [];
foreach ($model->authors as $authors) {
    $arAuthors[] = Html::a($authors->name, Url::to(['site/author', 'id' => $authors->id]));
}

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-detail-inner">
    <div class="row">
        <div class="col-md-5">
            <section class="page-content">
                <div class="images-container">
                    <div class="product-cover">
                        <img src="<?= $model->getImage() ?>" alt="<?= $name ?>">
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-7">
            <h1 class="h1"><?= $name ?></h1>
            <div class="product-information">
                <div id="list_book" class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Автор:</td>
                            <td><?= implode(', ', $arAuthors) ?></td>
                        </tr>
                        <tr>
                            <td>ISBN:</td>
                            <td><?= $model->isbn ?></td>
                        </tr>
                        <tr>
                            <td>Страниц:</td>
                            <td><?= $model->pages ?></td>
                        </tr>
                        <tr>
                            <td>Вес, г:</td>
                            <td><?= $model->weight ?></td>
                        </tr>
                        <tr>
                            <td>Переплет:</td>
                            <td><?= $model->binding->name ?></td>
                        </tr>
                        <tr>
                            <td>Язык:</td>
                            <td><?= $model->language->name ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
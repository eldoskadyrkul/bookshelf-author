<?php

use yii\helpers\Html;

$name = Html::encode($model->name);
$arAuthors = [];

foreach ($model->authors as $authors) {
    $arAuthors[] = $authors->name;
}
?>
    
            <section id="books">
                <div>
                    <div id="books_list">
                        <div class="books">
                            <article class="product-miniature">
                                <div class="book-contents">
                                    <div class="thumbnail-container">
                                        <a href="<?= \yii\helpers\Url::to(['site/book', 'id' => $model->id]) ?>">
                                            <img class="img-thumbnail img-responsive" width="100%" src="<?= $model->getImage() ?>" alt="<?= $name ?>">
                                        </a>
                                    </div>
                                    <div class="book-description">
                                        <h2 class="h1 book-title"><?= $name ?></h2>
                                        <h3><?= implode(', ', $arAuthors) ?></h3>
                                        <div class="book-cart">
                                            <div class="quickview">
                                                <a href="<?= \yii\helpers\Url::to(['site/book', 'id' => $model->id]) ?>" class="quick-view" data-link-action="quickview">
                                                    <i class="material-icons search"></i>
                                                    <em>Quick View</em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
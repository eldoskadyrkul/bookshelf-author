<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<section id="books">
    <div>
        <div id="books_list">
            <div class="books">
                <article class="product-miniature">
                    <div class="book-contents">
                        <div class="book-description">
                        	<div class="thumbnail-container"><a href="<?= Url::to(['site/author', 'id' => $model->id]) ?>"><img class="img-thumbnail img-responsive" width="100%" src="upload/noimage.jpg"></a></div>
                            <h2 class="h1 book-title"><?= count($model->books) ?></h2>
                            <h3><?= Html::encode($model->name)?></h3>
                            <div class="book-cart">
                                <div class="quickview"><a href="<?= Url::to(['site/author', 'id' => $model->id]) ?>" class="quick-view" data-link-action="quickview"><i class="material-icons search"></i><em>Quick View</em></a></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php


use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;





$this->title = 'Авторы книги: ' . $modelBook->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelBook->name, 'url' => ['view', 'id' => $modelBook->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="books-authors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'author.name',
                'format' => 'html',
                'value' => function (\app\models\entities\BooksAuthor $model) {
                    return Html::a($model->author->name, ['authors/view', 'id' => $model->author_id]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, \app\models\entities\BooksAuthor $model) {
                        return Html::a(\yii\bootstrap\Html::icon('trash'), [
                            'books/delete-authors',
                            'id_book' => $model->book_id,
                            'id_author' => $model->author_id
                        ],
                            [
                                'data' => [
                                    'confirm' => 'Вы уверены?',
                                    'method' => 'post'
                                ]
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
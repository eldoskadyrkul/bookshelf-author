<?php


use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="books-view">

    <h1>Книга: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить описание', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить автора', ['add-author', 'idBook' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'authors.name',
                'format' => 'html',
                'value' => function (\app\models\entities\Books $model) {
                    $arAuthors = [];
                    foreach ($model->authors as $author) {
                        $arAuthors[] = Html::a($author->name, ['authors/view', 'id' => $author->id]);
                    }
                    return $arAuthors ? implode(', ', $arAuthors) : 'Не заданы';
                }
            ],
            'pages',
            'isbn',
            'language.name',
            'binding.name',
            'weight',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function (\app\models\entities\Books $model) {
                    $result = 'Не задана';
                    if ($model->image) {
                        $result = Html::img($model->getImage(), [
                            'alt' => $model->name
                        ]);
                    }
                    return $result;
                }
            ]
        ],
    ]) ?>

</div>
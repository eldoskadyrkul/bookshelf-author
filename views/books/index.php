<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (\app\models\entities\Books $model) {
                    return Html::a($model->name, ['books/view', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'language.name',
                'format' => 'html',
                'value' => function (\app\models\entities\Books $model) {
                    return Html::a($model->language->name, ['languages/view', 'id' => $model->language->id]);
                }
            ],
            'pages',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
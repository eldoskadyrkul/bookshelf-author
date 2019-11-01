<?php
use yii\widgets\ListView;

$this->title = 'Каталог книг';
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_book',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'class' => 'col-xs-12 col-sm-8 col-md-12'
    ]
]); ?>
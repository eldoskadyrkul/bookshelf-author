<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';

?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_author',
    'options' => [
        'class' => 'row'
    ]
]); ?>
<?php


use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $model \app\core\entities\Authors */
/* @var $dataProviderBooks yii\data\ActiveDataProvider */

$name = Html::encode($model->name);
$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;

?>

<h1>Книги автора: <?= $name ?></h1>

<?= ListView::widget([
    'dataProvider' => $dataProviderBooks,
    'layout' => "{items}\n{pager}",
    'itemView' => '_book',
    'options' => [
        'class' => 'row'
    ]
]); ?>
<?php

/* @var $this yii\web\View */
/* @var $image \common\models\Image */
use yii\helpers\Url;
use yii\bootstrap\Html;
$this->title = 'Просмотр';
?>
<h1 class="title">Просмотр изображения</h1>
<a class="thumbnail" href="<?= $image->getPath() ?>"><img src="<?= $image->getPath() ?>" alt="<?= $image->description ?>"></a>
<h4>Категория: <?= $image->category->category ?></h4>
<h4>Описание: <?= $image->description ?></h4>
<h4>Загружено: <?= $image->created_at ?></h4>
<h4>Количество просмотров: <span class="badge"><?= $image->views ?></span></h4>
<?= Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-minus img-circle text-danger') . 'Удалить', ['site/delete', 'id' => $image->id], [
    'class' => 'btn icon-btn btn-danger',
    'data' => [
        'confirm' => 'Вы уверены, что хотите удалить?',
        'method' => 'post',
    ],
]) ?>
<?= Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-edit img-circle text-success') . 'Изменить', ['site/update', 'id' => $image->id], [
    'class' => 'btn icon-btn btn-success',
    'data' => [
        'method' => 'post',
    ],
]) ?>

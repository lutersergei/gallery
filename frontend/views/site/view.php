<?php

/* @var $this yii\web\View */
/* @var $image \common\models\Image */
use yii\helpers\Url;
$this->title = 'Просмотр';
?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="row ">
            <h1 class="title">Просмотр изображения</h1>
            <a class="thumbnail" href="<?= $image->getPath() ?>"><img src="<?= $image->getPath() ?>" alt="<?= $image->description ?>"></a>
            <h4>Описание: <?= $image->description ?></h4>
            <h4>Загружено: <?= $image->created_at ?></h4>
            <h4>Количество просмотров: <span class="badge"><?= $image->views ?></span></h4>
            <a class="btn icon-btn btn-warning" href="<?= Url::to(['image/delete', 'id' => $image->id]) ?>"><span class="glyphicon btn-glyphicon glyphicon-minus img-circle text-warning"></span>Remove</a>
            <a class="btn icon-btn btn-success" href="<?= Url::to(['image/edit', 'id' => $image->id]) ?>"><span class="glyphicon btn-glyphicon glyphicon-edit img-circle text-success"></span>Edit</a>
        </div>
    </div>
</div>

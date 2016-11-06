<?php

/* @var $this yii\web\View */
/* @var $images \common\models\Image[] */

use yii\helpers\Url;

$this->title = 'Gallery';
?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="row ">
            <h1 class="title">Image Gallery</h1>
            <?php foreach ($images as $image):?>
                <div class="thumbnail_new">
                    <a class="thumbnail" href="<?= Url::to(['site/view', 'id' => $image->id]) ?>">
                        <img class="imgage-thumbnail" src="<?= $image->getPath() //TODO Убрать вызов модели из вьюхи ?>" alt="<?= $image->description ?>">
                    </a>
                    <p>Просмотры: <span class="badge"><?= $image->views ?></span></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-push-4 col-sm-pull-4">
            <div class="button_upload">
                <a class="btn icon-btn btn-primary" href="<?= Url::to(['site/add']) ?>"><span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-primary"></span> Add New Image</a>
            </div>
        </div>
    </div>
</div>

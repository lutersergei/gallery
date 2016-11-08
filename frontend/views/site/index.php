<?php

/* @var $this yii\web\View */
/* @var $images \common\models\Image[] */

use yii\helpers\Url;
use yii\bootstrap\Html;

$this->title = 'Галерея';
?>
<div class="row">
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
<div class="row">
    <hr>
    <div class="col-sm-4 col-sm-push-4 col-sm-pull-4">
        <div class="button_upload">
            <?= Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-plus img-circle text-primary') . 'Add New Image', ['site/add-image'], ['class' => 'btn icon-btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\GalleryAsset;
use common\widgets\Alert;
use yii\helpers\Url;

GalleryAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <div class="row ">
                <ul class="nav nav-tabs">
                    <li><a href="<?= Url::to(['/site/index']) ?>">Gallery</a></li>
                    <li><a href="<?= Url::to(['/site/add']) ?>">Add Image </a></li>
                    <?php
                    if (Yii::$app->user->isGuest):
                        ?>
                        <li><a href="<?= Url::to(['/user/signup']) ?>">Sign Up</a></li>
                        <li><a href="<?= Url::to(['/user/login']) ?>">Login</a></li>
                        <?php
                    else:
                        ?>
                        <li role="presentation" ><a href=".<?= Url::to(['/user/profile']) ?>">Settings</a></li>
                        <?php
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

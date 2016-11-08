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
            <?php
            echo Nav::widget([
                'items' => [
                    [
                        'label' => 'Gallery',
                        'url' => ['site/index'],
                    ],
                    [
                        'label' => 'Add Image',
                        'url' => ['site/add-image'],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => ['user/profile'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Sign Up',
                        'url' => ['user/signup'],
                        'visible' => Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Login',
                        'url' => ['user/login'],
                        'visible' => Yii::$app->user->isGuest
                    ],
                ],
                'options' => ['class' =>'nav nav-tabs'],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

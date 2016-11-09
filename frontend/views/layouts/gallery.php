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
        <?php
        echo Nav::widget([
            'items' => [
                [
                    'label' => 'Галерея',
                    'url' => ['site/index'],
                ],
                [
                    'label' => 'Добавление',
                    'url' => ['site/add-image'],
                ],
                [
                    'label' => 'Профиль',
                    'url' => ['user/profile'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Регистрация',
                    'url' => ['user/signup'],
                    'visible' => Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Bход',
                    'url' => ['user/login'],
                    'visible' => Yii::$app->user->isGuest
                ],
            ],
            'options' => ['class' =>'nav nav-tabs'],
        ]);
        ?>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <aside class="col-sm-3">
            <h3>Recent Posts</h3>
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, optio eum …
                    </p>
                </a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, optio eum …
                    </p>
                </a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, optio eum …
                    </p>
                </a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, optio eum …
                    </p>
                </a>
            </div>






            <div class="container">
                <h3>Follow Us</h3>
                <div class="social">
                    <a href=""><i class="fa fa-3x fa-facebook-square"></i></a>
                    <a href=""><i class="fa fa-3x fa-twitter-square"></i></a>
                    <a href=""><i class="fa fa-3x fa-linkedin-square"></i></a>
                    <a href=""><i class="fa fa-3x fa-google-plus-square"></i></a>
                </div>

            </div>




        </aside>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

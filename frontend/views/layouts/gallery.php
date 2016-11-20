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
use frontend\assets\LightgalleryAsset;

GalleryAsset::register($this);
LightgalleryAsset::register($this);
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
            'activateParents' => true,
            'items' => [
                [
                    'label' => 'Галерея',
                    'url' => ['site/index'],
                ],
                [
                    'label' => 'Добавление',
                    'url' => ['site/add-image'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Профиль',
                    'items' => [
                        ['label' => 'Мои файлы', 'url' => ['user/files']],
                        '<li class="divider"></li>',
                        ['label' => 'Настройки', 'url' => ['user/profile']],
                        ['label' => 'Bыход', 'url' => ['user/logout']],
                    ],
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
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

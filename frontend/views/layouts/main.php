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
                    'url' => Url::to(['site/index']),
                ],
                [
                    'label' => 'Добавление',
                    'url' => Url::to(['site/add-image']),
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Профиль',
                    'items' => [
                        ['label' => 'Мои файлы', 'url' => Url::to(['user/profile'])],
                        '<li class="divider"></li>',
                        ['label' => 'Настройки', 'url' => Url::to(['user/profile'])],
                        ['label' => 'Bыход', 'url' => Url::to(['user/logout'])],
                    ],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Регистрация',
                    'url' => Url::to(['user/signup']),
                    'visible' => Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Bход',
                    'url' => Url::to(['user/login']),
                    'visible' => Yii::$app->user->isGuest
                ],
            ],
            'options' => ['class' =>'nav nav-tabs'],
        ]);
        ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

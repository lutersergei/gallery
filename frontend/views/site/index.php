<?php

/* @var $this yii\web\View */
/* @var $images \common\models\Pictures[] */
/* @var $categories \common\models\Category[] */
/* @var $count_pictures integer */
/* @var $users \common\models\User[] */

use yii\helpers\Url;
use yii\bootstrap\Html;
use common\widgets\Alert;
$this->title = 'Галерея';

//foreach ($images as $image)
//{
//    var_dump($image->average);
//    echo "<br>";
//    foreach ($image->ratings as $rating)
//    {
//        var_dump($rating->toArray());
//        echo "<br>";
//    }
//    echo "<br>";
//}
?>
<div class="row">
    <div class="col-sm-9">
        <h1 class="title">Image Gallery</h1>
    </div>
</div>
<div class="row">
    <aside class="col-sm-3 col-sm-push-9">
        <h3>Категории</h3>
        <div class="list-group">
            <a href="<?= Url::to(['site/index']) ?>" class="list-group-item">
                <span class="badge"><?= $count_pictures ?></span>
                <p class="list-group-item-text">
                    Все
                </p>
            </a>
            <?php foreach ($categories as $category):
                if($category->count_pictures):?>
                    <a href="<?= Url::to(['site/index', 'cat' => $category->id]) ?>" class="list-group-item">
                        <span class="badge"><?= $category->count_pictures ?></span>
                        <p class="list-group-item-text">
                            <?= $category->category ?>
                        </p>
                    </a>
                    <?php
                endif;
            endforeach;?>
        </div>
        <h3>Пользователи</h3>
        <div class="list-group">
            <?php foreach ($users as $user):
                if($user->count_pictures):?>
                    <a href="<?= Url::to(['site/index', 'user' => $user->id]) ?>" class="list-group-item">
                        <span class="badge"><?= $user->count_pictures ?></span>
                        <p class="list-group-item-text">
                            <?= $user->username ?>
                        </p>
                    </a>
                    <?php
                endif;
            endforeach;?>
        </div>
    </aside>
    <div class="col-sm-9 col-sm-pull-3">
        <?= Alert::widget() ?>
        <div id="lightgallery" class="row gallery">
            <?php foreach ($images as $image):
                $userRate = null;
                foreach ($image->ratings as $rating)
                {
                    if ($rating->user_id === Yii::$app->user->id)
                    {
                        $userRate = $rating->rating;
                        break;
                    }
                }
                ?>
                <div class="thumbnail_new">
                    <a class="thumbnail" href="<?= $image->getImagePath() ?>">
                        <img class="image-thumbnail" src="<?= $image->getThumbPath() //TODO Убрать вызов модели из вьюхи ?>" alt="<?= $image->description ?>">
                        <span class="badge rating"><?= round($image->average, 1) ?></span>
                    </a>
                    <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="input-group raty" data-rating="<?= $image->average ?>" data-userrate="<?= $userRate ?>" data-id="<?= $image->id ?>"></div>
                    <?php endif;?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <hr>
            <div class="col-sm-4 col-sm-push-4 col-sm-pull-4">
                <div class="button_upload">
                    <?= Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-plus img-circle text-primary') . 'Добавить', [Url::to(['site/add-image'])], ['class' => 'btn icon-btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
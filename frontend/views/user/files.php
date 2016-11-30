<?php
/* @var $this yii\web\View */
/* @var $images \common\models\Pictures[] */

use yii\helpers\Url;
use yii\bootstrap\Html;
use common\widgets\Alert;
$this->title = 'Файлы пользователя' . Yii::$app->user->id;
?>
<div id="gallery" class="gallery">
    <?php foreach ($images as $image):
        ?>
        <a class="picture" href="<?= $image->getImagePath() ?>">
            <img class="image-thumbnail" src="<?= $image->getThumbPath() //TODO Убрать вызов модели из вьюхи ?>" alt="<?= $image->description ?>">
        </a>
    <?php endforeach; ?>
</div>

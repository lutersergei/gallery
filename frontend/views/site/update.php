<?php
/* @var $this yii\web\View */
/* @var $image \common\models\Pictures */
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Редактирование';
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($image, 'description')->textarea(['rows' => 6])->label('Изменить описание', [
        'class' => 'bg-success'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('glyphicon btn-glyphicon glyphicon-edit img-circle text-success') . 'Изменить', [
            'class' => 'btn icon-btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

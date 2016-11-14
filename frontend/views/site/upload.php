<?php
/* @var $this yii\web\View */
/* @var $model \common\models\Pictures */
/* @var $categories \common\models\Category[] */

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = 'Загрузка в галерею';
$this->registerJsFile('js/category.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<h1>Загрузка файлов в галерею</h1>
<p class="bg-danger">Максимальный размер файла 20Mb !</p>
<?php
$form = ActiveForm::begin([
    'id' => 'ImageUploadForm',
    'layout' => 'default',
]);
echo $form->field($model, 'imageFile', [
    'enableLabel' => false
])->fileInput();
echo $form->field($model, 'category_id')->dropDownList($categories);
echo $form->field($model, 'description')->textarea(['autofocus' => true, 'rows' => 5]);
echo Html::submitButton(Html::icon('glyphicon btn-glyphicon glyphicon-ok img-circle text-success') . 'Загрузить!', ['class' => 'btn icon-btn btn-success']);
ActiveForm::end();
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Добавление категории</h4>
            </div>
            <div class="modal-body">
                <?= Html::input('text', 'category', '', ['id' => 'inputCat', 'class' => 'form-control', 'placeholder' => 'Новая категория']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button id="addCategory" type="button" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</div>

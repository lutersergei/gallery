<?php
/* @var $this yii\web\View */
/* @var $model \common\models\Image */
/* @var $categories \common\models\Category[] */

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = 'Загрузка в галерею';
?>
<h1>Загрузка файлов в галерею</h1>
<p class="bg-danger">Максимальный размер файла 5Mb !</p>
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

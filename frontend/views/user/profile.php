<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = 'Профиль пользователя';

?>
<div class="row">
    <h2>Очистить базу данных и удалить файлы</h2>

    <?php
    echo Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-trash img-circle text-danger') . 'Reset DB', ['user/reset'], [
        'class' => 'btn icon-btn btn-danger',
        'data' => [
            'method' => 'post'
        ]
    ] );
    ?>
</div>
<div class="row">
    <h2>Выйти из аккаунта администратора</h2>
    <?php
    echo Html::a(Html::icon('glyphicon btn-glyphicon glyphicon-log-out img-circle text-warning') . 'Logout', ['user/logout'], [
        'class' => 'btn icon-btn btn-warning',
        'data' => [
            'method' => 'post'
        ]
    ] );
    ?>
</div>

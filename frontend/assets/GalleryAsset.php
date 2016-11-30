<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Gallery asset bundle.
 */
class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'https://fonts.googleapis.com/css?family=Comfortaa:400,300&subset=latin,cyrillic',
        'css/justifiedGallery.min.css',
        'css/jquery.raty.css'
    ];
    public $js = [
        'js/jquery.raty.js',
        'js/jquery.justifiedGallery.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}

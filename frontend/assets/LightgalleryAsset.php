<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Gallery asset bundle.
 */
class LightgalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'lightgallery/dist/css/lg-fb-comment-box.min.css',
        'lightgallery/dist/css/lg-transitions.min.css',
        'lightgallery/dist/css/lightgallery.min.css'
    ];
    public $js = [
        'lightgallery/dist/js/lightgallery.min.js',
        'lightgallery/dist/js/lg-fullscreen.js',
        'lightgallery/dist/js/lg-zoom.min.js',
        'lightgallery/dist/js/lg-thumbnail.min.js',
        'js/jquery.mousewheel.min.js',
        'js/gallery.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}

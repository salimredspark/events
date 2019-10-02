<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/all.min.css',
        '//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
        'css/sb-admin-2.min.css',
        'css/custom.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.bundle.min.js',
        'js/jquery.easing.min.js',
        'js/sb-admin-2.min.js',
        'js/Chart.min.js',
        'js/chart-area-demo.js',
        'js/chart-pie-demo.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

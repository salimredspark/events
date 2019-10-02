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
        'css/bootstrap.min.css',
        'css/material-dashboard.css',
        'css/demo.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        '//fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',        
        'css/custom.css',
    ];
    public $js = [
        'js/jquery-3.1.0.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/chartist.min.js',
        'js/bootstrap-notify.js',
        'js/material-dashboard.js',
        'js/demo.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [ 'css/site.css',];
    public $js = [
       // 'position' => View::POS_END,
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,   // 这是设置所有js放置的位置
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParliamentAsset extends AssetBundle
{
    public $basePath = '@webroot/themes/parliament_theme/';
    public $baseUrl = '@web/themes/parliament_theme/';
    public $sourcePath = '@webroot/themes/parliament_theme/';
    public $css = [
        //'css/style.css',
        // 'css/responsive.css',
        'css/bootstrap.min.css',
        //'css/w3.css',
        'css/font-awesome.min.css',
        //'css/inner-style.css',
        //'css/inner-responsive.css',
        'css/font-awesome.min-4.7.0.css',
    ];
    public $js = [
        //'js/jquery.min.js',
        //'js/3.3.1_jquery.min.js',
        'js/4.2.1_bootstrap.min.js',
        'js/common.js',

    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}

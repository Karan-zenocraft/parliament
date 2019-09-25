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
        'css/style.css',
        'css/responsive.css',
        'css/bootstrap.min.css',
    ];
    public $js = [
        //'js/jquery.min.js',
        'js/common.js',
        'js/jquery.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

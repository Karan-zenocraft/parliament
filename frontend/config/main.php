<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'defaultRoute' => 'site/index',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'doubleModel' => [
                    'class' => 'claudejanz\mygii\generators\model\Generator',
                ],
            ],
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => false,
            'authTimeout' => 300,
            'loginUrl' => ['login'],
            'idParam' => '_frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            //  'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                /* 'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
                ], */
                'yii\web\JqueryAsset' => ['jsOptions' => ['position' => \yii\web\View::POS_HEAD]],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ($_SERVER['HTTP_HOST'] == "localhost") ? '/parliament' : '',
        ],
        'assetManager' => [
            'bundles' => [
                /* 'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
                ], */
                'yii\web\JqueryAsset' => ['jsOptions' => ['position' => \yii\web\View::POS_HEAD]],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl' => ($_SERVER['HTTP_HOST'] == "localhost") ? '/parliament' : '',
            'rules' => [
                'login' => 'site/login',
                'home' => 'site/index',
            ],
        ],
    ],
    'params' => $params,
];

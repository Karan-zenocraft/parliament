<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'doubleModel' => [
                    'class' => 'claudejanz\mygii\generators\model\Generator',
                ],
            ],
        ],
        'gridview' => ['class' => 'kartik\grid\Module'],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => false,
            'authTimeout' => 300,
            'idParam' => '_backend',
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
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\web\JqueryAsset' => ['jsOptions' => ['position' => \yii\web\View::POS_HEAD]],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl' => ($_SERVER['HTTP_HOST'] == "localhost") ? '/parliament/admin' : '/admin',
            'rules' => [
                'login' => 'site/login',
                'dashboard' => 'site/index',
                'manage-users' => 'users/index',
                'create-user' => 'users/create',
                'update-user/<id>' => 'users/update',
                'delete-user/<id>' => 'users/delete',
                'manage-representatives' => 'representatives/index',
                'create-representative' => 'representatives/create',
                'update-representative/<id>' => 'representatives/update',
                'delete-representative/<id>' => 'representatives/delete',
            ],
        ],
        'request' => [
            'baseUrl' => ($_SERVER['HTTP_HOST'] == "localhost") ? '/parliament/admin' : '/admin',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pbB0NvlmxlWRk7XFCN_7XUC2uvX0vyCD',
        ],
    ],
    'params' => $params,
];

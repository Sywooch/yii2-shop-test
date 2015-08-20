<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'language' => 'ru-RU',
    'name' => 'Yii2 магазин',
    //'name_admin_panel' => 'Админка магазина',
    //'name2' => 'Админка магазина',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
                //'<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<alias:\w+>' => '<controller>/view',
                '<controller:category|product>' => '<controller>/index',
                '<action:\w+>' => 'site/<action>',
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdkf7RrZdpFP41VD0Zzoo7FtNvUM3iAT',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'booleanFormat' => ['Нет', 'Да'],
            'dateFormat' => 'php:d.m.Y', //Тут можно формат вывода дат по умолчанию настроить
            'datetimeFormat' => 'php:d.m.Y H:i',
            'timeFormat' => 'short',
            'nullDisplay' => '<span style="color:red">Не задано</span>',
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok 
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/store', //path to origin images
            'imagesCachePath' => 'upload/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick' ,GD
            'placeHolderPath' => '@webroot/upload/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
            'className' => 'app\models\Image',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    $config['components']['log']['targets'][] = [
        'class' => 'yii\log\FileTarget',
        'levels' => ['info'],
        'categories' => ['apiRequest'],
        'logFile' => '@app/runtime/logs/API/requests.log',
        'maxFileSize' => 1024 * 2,
        'maxLogFiles' => 20,
    ];
    $config['components']['log']['targets'][] = [
        'class' => 'yii\log\FileTarget',
        'levels' => ['info'],
        'categories' => ['apiResponse'],
        'logFile' => '@app/runtime/logs/API/response.log',
        'maxFileSize' => 1024 * 2,
        'maxLogFiles' => 20,
    ];
}

return $config;

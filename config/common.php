<?php

return [
    'id'         => 'yii2-minimal',
    'name'       => getenv('APP_NAME') ?? null,
    'basePath'   => dirname(__DIR__).'/',
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'bootstrap'  => YII_DEBUG ? ['log', 'debug', 'gii'] : ['log'],
    'aliases'    => [
        '@root'  => dirname(__DIR__),
        '@webroot'  => dirname(__DIR__),
        '@app'   => dirname(__DIR__) . '/app',
        '@app/views' => dirname(__DIR__) . '/views',
        '@views' => dirname(__DIR__) . '/views',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container'  => [
        'definitions' => [
            'yii\helpers\Html'                 => 'yii\bootstrap5\Html',
            'yii\bootstrap\Html'                 => 'yii\bootstrap5\Html',
            'yii\bootstrap\BootstrapAsset'       => 'yii\bootstrap5\BootstrapAsset',
            'yii\bootstrap\BootstrapPluginAsset' => 'yii\bootstrap5\BootstrapPluginAsset',
        ],
    ],
    'components' => [
        'db'        => [
            'class'             => 'yii\db\Connection',
            'dsn'               => (getenv('DB_TYPE') ?: 'mysql') . ':host=' . (getenv('DB_HOST') ?: 'localhost') . ';port=' . (getenv('DB_PORT') ?: '3306') . ';dbname=' . getenv('DB_NAME'),
            'username'          => getenv('DB_USERNAME'),
            'password'          => getenv('DB_PASSWORD'),
            'charset'           => 'utf8',
            'attributes'        => [PDO::ATTR_CASE => PDO::CASE_LOWER],
            'enableSchemaCache' => true,
        ],
        'redis'     => getenv('CACHE') === 'redis' ? [
            'class' => 'yii\redis\Connection',
        ] : null,
        'memcache'  => getenv('CACHE') === 'memcache' ? [
            'class' => 'yii\memcache\Connection',
        ] : null,
        'cache'     => [
            'class'     => (getenv('CACHE') === 'redis') ? 'yii\redis\Cache' : ((getenv('CACHE') === 'file') ? 'yii\caching\FileCache' : ((getenv('CACHE') === 'memcache') ? 'yii\caching\MemCache' : 'yii\caching\DummyCache')),
            'keyPrefix' => getenv('CACHE_KEY_PREFIX') ?: 'CACHE_',
        ],
        'formatter' => [
            'datetimeFormat' => 'dd-MM-yyyy HH:mm:ss',
            'dateFormat'     => 'dd-MM-yyyy',
            'timeFormat'     => 'HH:mm:ss',
        ],
        'log'       => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'          => 'yii\log\FileTarget',
                    'levels'         => ['error', 'warning'],
                    'enableRotation' => true,
                    'maxFileSize'    => 1024,
                    'maxLogFiles'    => 5,
                    'logVars'        => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION',    /*'_SERVER',*/],
                ],
            ],
        ],
        'i18n'      => [
            'translations' => [
                'yii' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@yii/messages',
                    'sourceLanguage' => 'en-US',
                ],
                '*'   => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@app/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
    ],
    'modules'    => YII_DEBUG ? [
        'debug' => [
            'class'      => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
        ],
        'gii'   => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
            /*'generators' => [
                'model' => ['class' => 'yii\gii\generators\model\Generator'],
                'crud' => ['class' => 'yii\gii\generators\crud\Generator'],
                'controller' => ['class' => 'yii\gii\generators\controller\Generator'],
                'form' => ['class' => 'yii\gii\generators\form\Generator'],
                'module' => ['class' => 'yii\gii\generators\module\Generator'],
                'extension' => ['class' => 'yii\gii\generators\extension\Generator'],
            ],*/
        ],
    ] : [],
];

<?php
error_reporting(-1);
ini_set('display_errors', true);
defined('YII_DEBUG') or define('YII_DEBUG', true || $_SERVER['REMOTE_ADDR'] == '127.0.0.1');
defined('YII_ENV') or define('YII_ENV', YII_DEBUG ? 'dev' : 'prod');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/config/common.php',
    require __DIR__ . '/config/web.php'
);

(new yii\web\Application($config))->run();

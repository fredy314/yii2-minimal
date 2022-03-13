<?php

if (file_exists(dirname(__DIR__) . '/.env')) {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__));
    $dotenv->load();
    $dotenv->ifPresent('YII_DEBUG')->isBoolean();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD']);
    $dotenv->ifPresent('DB_TYPE')->allowedValues(['mysql', 'pgsql', 'sqlite']);
    $dotenv->ifPresent('DB_PORT')->isInteger();
    $dotenv->ifPresent('CACHE')->allowedValues(['redis', 'file', 'memcache', 'dummy']);
}


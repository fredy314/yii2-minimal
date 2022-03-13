<?php

return [
    'components' => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdfgsd;lgh23w453gw98rehw-e98rnewr',
            'enableCsrfCookie'    => false,
            'ipHeaders'           => [
                'X-Forwarded-For',
                'X-Real-Ip',
                'true-client-ip',
                'cf-connecting-ip',
            ],
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
            'autoRenewCookie' => true,
            'identityCookie'  => ['name' => 'coins-identity', 'httpOnly' => true, 'secure' => true],
            'authTimeout'     => 3600 * 4, // auth expire
        ],
        'session'      => [
            'class'        => getenv('CACHE') === 'redis' ? 'yii\redis\Session' : 'yii\web\Session',
            'name'         => 'coins-session-id',
            'cookieParams' => ['httponly' => true, 'secure' => true, 'lifetime' => 3600 * 4],
            'timeout'      => 3600 * 4, //session expire
            'useCookies'   => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'class'           => 'yii\web\AssetManager',
            'linkAssets'      => true,
            'appendTimestamp' => true,
        ],
        'urlManager'   => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'normalizer'      => [
                'class'                  => 'yii\web\UrlNormalizer',
                'collapseSlashes'        => true,
                'normalizeTrailingSlash' => true,
            ],
            'rules'           => [
                '/'                                    => 'site/index',
                'rss.xml'                              => 'news/rss',
                'signup/<invitation_code:[\w\-]+>'     => 'site/signup',
                '<slug:(faq)>/<category:[\w\-]+>.html' => 'page/show',
                '<slug:[\w\-]+>.html'                  => 'page/show',

                '<module:(account|admin)>/<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\w\-]+>/<id:[\d]+>.html' => '<module>/<controller>/<action>',
                '<module:(account|admin)>/<controller:[\w\-]+>/<action:[\w\-]+>/<id:[\d]+>.html'                => '<module>/<controller>/<action>',
                '<module:(account|admin)>/<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\w\-]+>.html'            => '<module>/<controller>/<action>',
                '<module:(account|admin)>/<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\w\-]+>'                 => '<module>/<controller>/<action>',
                '<module:(account|admin)>/<controller:[\w\-]+>/<action:[\w\-]+>'                                => '<module>/<controller>/<action>',
                '<module:(account|admin)>/<controller:[\w\-]+>/<slug:[\w\-]+>/<id:[\d]+>.html'                  => '<module>/<controller>/show',
                '<module:(account|admin)>/<controller:[\w\-]+>/<id:[\d]+>.html'                                 => '<module>/<controller>/view',
                '<module:(account|admin)>/<controller:[\w\-]+>/<slug:[\w\-]+>.html'                             => '<module>/<controller>/show',
                '<module:(account|admin)>/<controller:[\w\-]+>'                                                 => '<module>/<controller>/index',
                '<module:(account|admin)>'                                                                      => '<module>/default/index',

                '<controller:[\w\-]+>/<id:[\d]+>.html'                               => '<controller>/view',
                '<controller:[\w\-]+>/<slug:[\d]+>.html'                             => '<controller>/show',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\d]+>/<id:[\d]+>.html' => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:[\d]+>.html'              => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\d]+>.html'            => '<controller>/<action>',
                '<controller:(api|news|telegram)>'                                   => '<controller>/index',
                '<action:[\w\-]+>'                                                   => 'site/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>'                              => '<controller>/<action>',
            ],
        ],
    ],
];

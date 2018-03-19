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
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'shop\entities\User\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
                'domain' => $params['cookieDomain'],
            ],
//            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' =>'.shop'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
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

        'frontendUrlManager' => require __DIR__ . '/urlManager.php',
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',

        'urlManager' => function () {
            return Yii::$app->get('frontendUrlManager');
        },

        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<_a:login|logout>' => 'site/<a>',

                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',
            ],
        ],*/

    ],
    'params' => $params,
];

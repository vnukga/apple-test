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
    'bootstrap' => ['log'],
    'modules' => [
        'apple' => [
            'class' => 'backend\modules\apple\Module',
            'defaultRoute' => 'apple/index',
            'as access' => [ // if you need to set access
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'] // all auth users
                    ],
                ]
            ],
        ],
    ],
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'i18n' => [
            'translations' => [
                'apple*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => __DIR__ . '/../modules/apple/messages',
                    'fileMap' => [
                        'apple'       => 'apple.php',
                        'apple/error' => 'error.php',
                        'apple/user'  => 'user.php'
                    ],
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => __DIR__ . '/../../messages',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                        'app/user'  => 'user.php'
                    ],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

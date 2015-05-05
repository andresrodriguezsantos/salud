<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //'cookieValidationKey' => 'hdahsdhiahsedebdhbsd-23',
            'cookieValidationKey' => 'UMyf1M_hUT7sz9ZWBJsCaCj4dYbNFq54'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuario',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'clinikboxcolombia@gmail.com',
                'password' => 'clinikboxcolombia2015',
                'port' => '587',
                'encryption' => 'tls',
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
        'db' => require(__DIR__ . '/db.php'),
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource'
                ],
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource'
                ],
            ],
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'ipgeobase' => [
            'class' => 'himiklab\ipgeobase\IpGeoBase',
            'useLocalDB' => false,
        ],
    ],
    'modules' => [
        'administracion' => [
            'class' => 'app\modules\admin\administracion',
        ],
        'optometria' => [
            'class' => 'app\modules\optometria\optometria',
            'defaultRoute' => 'main'
        ],
        'paciente' => [
            'class' => 'app\modules\paciente\paciente',
        ],
        'profesional' => [
            'class' => 'app\modules\profesional\profesional',
        ],
        'laboratorio' => [
            'class' => 'app\modules\laboratorio\laboratorio',
            'defaultRoute' => 'admin'
        ],
        'medicamento' => [
            'class' => 'app\modules\medicamento\medicamento',
            'defaultRoute' => 'admin'
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;

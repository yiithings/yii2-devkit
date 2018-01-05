<?php

$config = [
    'id' => 'yii2-devkit',
    'name' => 'Yii2 DevKit',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(dirname(__DIR__))) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];

$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
];

$config['bootstrap'][] = 'devkit';
$config['modules']['devkit'] = [
    'class' => 'yiithings\devkit\Module',
    'config' => [
        '@app/config/main.php',
        '@app/config/console.php',
    ]
];

return $config;

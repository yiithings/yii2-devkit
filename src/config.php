<?php

return [
    'components' => [
    ],
    'controllerMap' => [
        'ide-helper' => [
            'class' => 'yiithings\devkit\commands\IdeHelperController',
        ],
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::className(),
            'templateFile' => '@jamband/schemadump/template.php',
        ],
        'schemadump' => [
            'class' => jamband\schemadump\SchemaDumpController::className(),
        ],

    ]
];
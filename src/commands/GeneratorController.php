<?php

namespace yiithings\devkit\commands;

use yii\console\Controller;

class GeneratorController extends Controller
{
    public $ideHelper = [];

    public function actions()
    {
        return [
            'ide-helper' => [
                'class' => IdeHelperAction::className(),
            ] + $this->ideHelper,
            'schema-create' => SchemaCreateAction::className(),
            'schema-drop' => SchemaDropAction::className(),
        ];
    }
}
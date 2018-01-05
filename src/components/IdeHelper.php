<?php

namespace yiithings\devkit\components;

use iiifx\Yii2\Autocomplete\Component;
use yiithings\devkit\commands\IdeHelperController;

class IdeHelper extends Component
{
    public $controllerMap = [];

    public function init()
    {
        parent::init();

        if (empty($this->controllerMap)) {
            $this->controllerMap = [
                'ide-helper' => IdeHelperController::className(),
            ];
        }
    }
}
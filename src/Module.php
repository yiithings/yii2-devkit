<?php

namespace yiithings\devkit;

use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;
use yiithings\devkit\commands\GeneratorController;

/**
 * Class Module
 *
 * @package yiithings\devkit
 * @property array $config
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $defaultRoute = 'generate';

    public $generator = [];

    public function bootstrap($app)
    {
        if ($app instanceof ConsoleApplication) {
            $app->controllerMap[$this->id] = [
                'class' => GeneratorController::className(),
            ] + $this->generator;
        }
    }
}
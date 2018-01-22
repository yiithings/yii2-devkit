<?php

namespace yiithings\devkit\commands;

use Exception;
use iiifx\Yii2\Autocomplete\Builder;
use iiifx\Yii2\Autocomplete\Config;
use Yii;
use yii\base\Action;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yiithings\devkit\Module;

/**
 * Help you generate IDE auto-completion file.
 *
 * @package yiithings\develop\console\controllers
 * @property Module $module
 */
class IdeHelperAction extends Action
{
    /**
     * @var string
     */
    public $generatorPath = '@vendor/../.ide_helper.php';

    /**
     * Generate auto-completion codes.
     */
    public function run()
    {
        // Don't call echoInfo() method, because this method maybe echo many times.
        try {
            $configList = $this->getConfig();
            $config = new Config([
                'files' => $configList,
            ]);
            $builder = new Builder([
                'components' => $config->getComponents(),
                'template'   => require(__DIR__ . '/../views/ide-helper/template.php'),
            ]);
            $result = Yii::getAlias($this->generatorPath);
            $result = FileHelper::normalizePath($result);
            if ($builder->build($result)) {
                $this->controller->stdout("IDE helper generate success: $result\n", Console::FG_GREEN);
            } else {
                $this->controller->stderr("IDE helper generate Fail!\n", Console::FG_RED);
            }
        } catch (Exception $exception) {
            $this->controller->stderr("{$exception->getMessage()}\n", Console::FG_RED);
        }
    }

    private $_config;

    public function getConfig()
    {
        if ($this->_config === null) {
            $config = [];
            if (false !== Yii::getAlias('@common', false)) {
                $config = array_merge($config, [
                    '@common/config/main.php',
                    '@common/config/main-local.php',
                ]);
            }
            if (false !== Yii::getAlias('@console', false)) {
                $config = array_merge($config, [
                    '@console/config/main.php',
                    '@console/config/main-local.php',
                ]);
            }
            if (false !== Yii::getAlias('@backend', false)) {
                $config = array_merge($config, [
                    '@backend/config/main.php',
                    '@backend/config/main-local.php',
                ]);
            }
            if (false !== Yii::getAlias('@frontend', false)) {
                $config = array_merge($config, [
                    '@frontend/config/main.php',
                    '@frontend/config/main-local.php',
                ]);
            }
            if (false === Yii::getAlias('@common', false) && false !== Yii::getAlias('@app', false)) {
                $config = array_merge($config, [
                    '@app/config/console.php',
                    '@app/config/web.php',
                ]);
            }
            $this->_config = $config;
        }

        return $this->_config;
    }

    public function setConfig($config)
    {
        $this->_config = $config;
    }
}
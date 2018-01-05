<?php

namespace yiithings\devkit\commands;

use Exception;
use iiifx\Yii2\Autocomplete\Builder;
use iiifx\Yii2\Autocomplete\Component;
use iiifx\Yii2\Autocomplete\Config;
use iiifx\Yii2\Autocomplete\Controller;
use Yii;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yiithings\devkit\components\IdeHelper;
use yiithings\devkit\Module;

/**
 * Help you generate IDE auto-completion file.
 *
 * @package yiithings\develop\console\controllers
 * @property Module $module
 */
class IdeHelperController extends Controller
{
    public $component = '';
    /**
     * @var IdeHelper
     */
    private $_component;

    /**
     * Generate auto-completion codes.
     */
    public function actionIndex()
    {
        // Don't call echoInfo() method, because this method maybe echo many times.
        try {
            $component = $this->getComponent();
            $configList = $this->getConfig($component);
            $config = new Config([
                'files' => $configList,
            ]);
            $builder = new Builder([
                'components' => $config->getComponents(),
                'template'   => require(__DIR__ . '/../views/ide-helper/template.php'),
            ]);
            if ($component->result === null) {
                $component->result = '@vendor/../.ide_helper.php';
            }
            $result = Yii::getAlias($component->result);
            $result = FileHelper::normalizePath($result);
            if ($builder->build($result)) {
                $this->stdout("IDE helper generate success: $result\n", Console::FG_GREEN);
            } else {
                $this->stderr("IDE helper generate Fail!\n", Console::FG_RED);
            }
        } catch (Exception $exception) {
            $this->stderr("{$exception->getMessage()}\n", Console::FG_RED);
        }
    }

    protected function getComponent ()
    {
        if ($this->_component === null) {
            if (empty($this->component)) {
                $this->_component = Yii::createObject(['class' => IdeHelper::className()]);
            } else {
                $this->_component = parent::getComponent();
            }
        }

        return $this->_component;
    }

    protected function getConfig(Component $component)
    {
        if ($this->module) {
            return $this->module->getConfig();
        }
echo 'aa';
        return parent::getConfig($component);
    }
}
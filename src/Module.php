<?php

namespace yiithings\devkit;

use Yii;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;

/**
 * Class Module
 *
 * @package yiithings\devkit
 * @property array $config
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    private $_config;

    public function bootstrap($app)
    {
        if ($app instanceof ConsoleApplication) {
            Yii::configure($this, require __DIR__ . '/config.php');
        }
    }

    /**
     * @return mixed
     */
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
            $this->setConfig($config);
        }

        return $this->_config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        array_filter($config, function($value) {
            return is_file(Yii::getAlias($value));
        });

        $this->_config = $config;
    }
}
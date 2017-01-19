<?php

class WeChatModule extends CWebModule
{
    public function init()
    {
        $configPath = dirname(__FILE__) . '/config/' . strtolower(APPLICATION_ENV) .'/main.php';
        if (is_readable($configPath)) {
            $config = require($configPath);
            Yii::app()->configure($config);
        } else {
            throw new CHttpException(405, "$configPath is not readalbe");
        }
        $moduleName = $this->getId();
        !defined('MODULE_NAME') && define('MODULE_NAME', $moduleName);
        return parent::init();
    }
}

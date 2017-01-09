<?php
!defined('TEST') && define('TEST', 'TEST');
!defined('LIB_PATH') && define('LIB_PATH', dirname(__FILE__) . '/../../../lib/yii-1.1.13');
$test_env = getenv('APPLICATION_ENV');
$module_name = getenv('MODULE_NAME');
$idc_num = @intval(getenv('IDC_NUM'));
$idc_id = @intval(getenv('IDC_ID'));
if ($idc_num <= 0) {
    throw new ErrorException("IDC_NUM is invalid! please export it in shell");
}
!defined('MODULE_NAME') && define('MODULE_NAME', $module_name);
!defined('APPLICATION_ENV') && define('APPLICATION_ENV', $test_env);
!defined('IDC_NUM') && define('IDC_NUM', $idc_num); // 机房数
!defined('IDC_ID') && define('IDC_ID', $idc_id); // idc数字编号，编号从0开始

// change the following paths if necessary
$yiit = constant('LIB_PATH') . '/yiit.php';
require_once($yiit);

Yii::$enableIncludePath = false;
$globalConfig = dirname(__FILE__) . '/../config/' . $test_env . '/test.php';
Yii::createWebApplication($globalConfig);
// module custom config
$moduleConfig = require  Yii::getPathOfAlias("application.modules.$module_name.config.$test_env") . '/test.php';
Yii::app()->configure($moduleConfig);

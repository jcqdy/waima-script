<?php
mb_internal_encoding("UTF-8");
$hostname = gethostname();

define('IDC_NUM', 2); // 机房数
define('IDC_ID', 1); // idc数字编号，编号从0开始
define('APPLICATION_ENV', 'production_cn');
define('ENV_ONLINE', 1);

// 再次check设置
if (! defined('IDC_NUM') || ! defined('IDC_ID')) {
    header('Server Error', true, 500); // 否则直接返回错误
    exit(1);
}

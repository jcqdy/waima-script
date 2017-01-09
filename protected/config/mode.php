<?php
mb_internal_encoding("UTF-8");
$hostname = gethostname();

if ($hostname == 'jenkins') {
    define('IDC_NUM', 1); // 机房数
    define('IDC_ID', 0); // idc数字编号，编号从0开始
    define('APPLICATION_ENV', 'testing');
    //define('YII_TRACE_LEVEL', 3);
} elseif ($hostname == 'cn-bj-testing0' || $hostname == 'cn-bj-testing1') {
    define('IDC_NUM', 1); // 机房数
    define('IDC_ID', 0); // idc数字编号，编号从0开始
    define('APPLICATION_ENV', 'testing');
    //define('YII_TRACE_LEVEL', 3);
} elseif ($hostname == 'cn-bj-testing-dev0' || $hostname == 'cn-bj-testing-dev1') {
    define('IDC_NUM', 1); // 机房数
    define('IDC_ID', 0); // idc数字编号，编号从0开始
    define('APPLICATION_ENV', 'testing_dev');
    //define('YII_TRACE_LEVEL', 3);
} elseif ($hostname == 'en-ap-testing-dev0') { // 新加坡测试开发服务器.
    define('IDC_NUM', 1); // 机房数
    define('IDC_ID', 0); // idc数字编号，编号从0开始
    define('APPLICATION_ENV', 'testing_dev_en');
    //define('YII_TRACE_LEVEL', 3);
} else {
    // 机器名须是, 机房-系统-类别+数字编号
    // 国内阿里云机房 cn-cc-app00, cn-cc-app01
    // 国内亚马逊机房 cn-bj-cc-app00, cn-bj-cc-app01
    // 国外机房 en-cc-app00, en-cc-app02
    $arrHost = explode('-', $hostname);
    $idc = $arrHost[0];
    $region = '';
    if (isset($arrHost[1])) {
        $region = $arrHost[1];
    }
    if ($idc == 'cn' && $region == 'bj') {
        define('IDC_NUM', 2); // 机房数
        define('IDC_ID', 0); // idc数字编号，编号从0开始
        define('APPLICATION_ENV', 'production_cn_bj');
        define('ENV_ONLINE', 1);
    } elseif ($idc == 'cn') {
        define('IDC_NUM', 2); // 机房数
        define('IDC_ID', 0); // idc数字编号，编号从0开始
        define('APPLICATION_ENV', 'production_cn');
        define('ENV_ONLINE', 1);
    } elseif ($idc == 'en') {
        define('IDC_NUM', 2); // 机房数
        define('IDC_ID', 1); // idc数字编号，编号从0开始
        define('APPLICATION_ENV', 'production_en');
        define('ENV_ONLINE', 1);
    } else {
        define('IDC_NUM', 1); // 机房数
        define('IDC_ID', 0); // idc数字编号，编号从0开始
        define('APPLICATION_ENV', 'newdev');
    }
}

// 再次check设置
if (! defined('IDC_NUM') || ! defined('IDC_ID')) {
    header('Server Error', true, 500); // 否则直接返回错误
    exit(1);
}

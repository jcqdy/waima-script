<?php
$discoverInnerTimeOut = 2000;        // 超时时间
$discoverInnerConTimeOut = 100;     // 连接超时时间
$discoverInnerTryTimes = 3;         // 重试次数

$conf = require realpath(dirname(__FILE__) . '/../../../../config/testing_dev/main.php');
$serHost = $conf['params']['recServHost'];
return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'components'=>array(
        ),
        'params' => array(
            'flex' => array(
                'getPicBatch' => array(
                    'hosts' => ENABLE_MS ? 'http://phototask-task-ms-dev.360in.com': 'http://127.0.0.1:8009',
                ),
                'isLike' => array(
                    'hosts' => ENABLE_MS ? 'http://phototask-comment-ms-dev.360in.com' : 'http://127.0.0.1:8009',
                ),
                'getUinfoByUid' => array(
                    'hosts' => ENABLE_MS ? 'http://phototask-user-ms-dev.360in.com' : 'http://127.0.0.1:8009',
                ),
                'userNewest' => array(
                    'hosts' => ENABLE_MS ? 'http://phototask-task-ms-dev.360in.com' : 'http://127.0.0.1:8009',
                ),
                'recSer_hotWork' => array(
                    'url' => '/api/batch/query',//RecServHelper::$getBatchRecs,
                    'hosts' => $serHost,
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
                'recSer_hotUser' => array(
                    'url' => '/api/batch/query',//RecServHelper::$getBatchRecs,
                    'hosts' => $serHost,
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
                'recSer_hotPhotoGame' => array(
                    'url' => '/api/batch/query',//RecServHelper::$getBatchRecs,
                    'hosts' => $serHost,
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
            ),
        ),
    )
);

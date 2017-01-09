<?php


return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'components'=>array(
        ),
        'params' => array(
            'flex' => array(
                'getPicBatch' => array(
                    'url' => '/task/inner/getPic/batch',//TaskModuleHelper::$getPicBatchApi,
                    'hosts' => 'http://127.0.0.1:8009',
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
                'isLike' => array(
                    'url' => '/comment/inner/like/isLike',//CommentHelper::$isLike,
                    'hosts' => 'http://127.0.0.1:8009',
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
                'getUinfoByUid' => array(
                    'url' => '/user/inner/Uinfo',//UserModuleHelper::$getUserInfoApi,
                    'hosts' => 'http://127.0.0.1:8009',
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
                'userNewest' => array(
                    'url' => '/task/inner/getPic/userNewest',//TaskModuleHelper::$getUserNewestApi,
                    'hosts' => 'http://127.0.0.1:8009',
                    'parser' => 'FlexUtilHttpParser::parse', // parser格式必须是 类名::方法名 //是否带cookie
                    'timeout' => $discoverInnerTimeOut,
                    'conn_timeout' => $discoverInnerConTimeOut,
                    'try' => $discoverInnerTryTimes
                ),
            ),
        ),
    )
);

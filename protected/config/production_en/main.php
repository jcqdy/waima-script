<?php
// 微服务架构是否生效
defined('ENABLE_MS') or define('ENABLE_MS', true);

//require_once(dirname(__FILE__) . '/../../../../config/configparser.php');
//pg redis hosts
$pgRedisHosts = array(
    array('host' => '10.90.19.87', 'port' => 6381),
    array('host' => '10.90.19.87', 'port' => 6382),
    array('host' => '10.90.19.88', 'port' => 6381),
    array('host' => '10.90.19.88', 'port' => 6382),
);


// amazonaws write redis hosts
$amzRedisWriteHosts = array(
    array('host' => '10.90.19.86', 'port' => 6380),
);

// amazonaws read redis hosts
$amzRedisReadHosts = array(
    array('host' => '10.90.19.86', 'port' => 6380),
);

/////////////////////////迁移配置分割线///////////////////////////

//北京分布式redis的外网配置
$pgRedisOpenHosts = array(
//    array('host' => '54.222.181.58', 'port' => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.67.64', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.222.128.28', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.222.230.191', 'port' => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.50.141', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.74.71', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.67.64', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.222.128.28', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.50.141', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.74.71', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.50.141', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.50.141', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.74.71', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.74.71', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.67.64', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.67.64', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.222.128.28', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.222.128.28', 'port'  => 6380, 'connTimeOut' => 1),
//    array('host' => '54.223.49.173', 'port'  => 6379, 'connTimeOut' => 1),
//    array('host' => '54.223.49.173', 'port'  => 6380, 'connTimeOut' => 1),
);

// 北京机房 ElasticCache 的写操作代理
$amzRedisWriteProxyHosts = array(
    array('host' => '54.222.185.188', 'port' => 22122, 'connTimeOut' => 3),
);

// 北京机房 ElasticCache 的读操作代理
$amzRedisReadProxyHosts = array(
    array('host' => '54.222.185.188', 'port' => 22123, 'connTimeOut' => 3),
);

// 新加坡分布式redis
$sgPgRedisHosts = array(
    array('host' => 'internal-en-ap-redis-elb-inner-656017240.ap-southeast-1.elb.amazonaws.com', 'port' => 22121, 'connTimeOut' => 1),
//    array('host' => '10.90.19.87', 'port' => 6379),
//    array('host' => '10.90.19.87', 'port' => 6380),
//    array('host' => '10.90.19.88', 'port' => 6379),
//    array('host' => '10.90.19.88', 'port' => 6380),
);

// 新加坡复制集redis,写操作配置
$sgAmzRedisWriteHosts = array(
//    array('host' => 'internal-en-ap-redis-elb-inner-656017240.ap-southeast-1.elb.amazonaws.com', 'port' => 22122, 'connTimeOut' => 1),
    array('host' => 'internal-en-ap-redis-elb-inner-22122-1783189641.ap-southeast-1.elb.amazonaws.com', 'port' => 22122, 'connTimeOut' => 1),
//    array('host' => '10.90.19.84', 'port' => 6379),
);
// 新加坡复制集redis,读操作配置
$sgAmzRedisReadHosts = array(
//    array('host' => 'internal-en-ap-redis-elb-inner-656017240.ap-southeast-1.elb.amazonaws.com', 'port' => 22123, 'connTimeOut' => 1),
    array('host' => 'internal-en-ap-redis-elb-inner-22123-48576656.ap-southeast-1.elb.amazonaws.com', 'port' => 22123, 'connTimeOut' => 1),
//    array('host' => '10.90.19.84', 'port' => 6379),
//    array('host' => '10.90.19.85', 'port' => 6379),
//    array('host' => '10.90.19.86', 'port' => 6379),
);

// 迁移演练时,启用这个配置

//$pgRedisHosts = $pgRedisOpenHosts;
//$amzRedisWriteHosts = $amzRedisWriteProxyHosts;
//$amzRedisReadHosts = $amzRedisReadProxyHosts;

$pgRedisHosts = $sgPgRedisHosts;
$amzRedisWriteHosts = $sgAmzRedisWriteHosts;
$amzRedisReadHosts = $sgAmzRedisReadHosts;


return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params' => array(
            'picHost' => 'http://phototask.c360dn.com/',
            'ssoUser' => array(
                'host' => 'https://i-inner.360in.com',
                //'host' => 'https://i.camera360.com',
                'appkey' => 'fd8463e40988de06', // change to your appkey
                'appsecret' => '825b682ffd8463e40988de0695328954', // change to your appsecret
            ),
            //'pushHost' => 'https://pushmsg.camera360.com',
            //'pushAndroidEnv' => 'production',
            //'pushIosEnv' => 'production',
            'pushAndroidHost' => 'https://push-gcm.camera360.com',
            'pushAndroidEnv' => 'production',
            'pushIosHost' => 'https://push-gcm.camera360.com',
            'pushIosEnv' => 'production',
            'qboxCallbackHost' => 'http://phototask-api.360in.com',
            'innerHost' => 'http://127.0.0.1:8009',
            'microService' => array(
                'channel'   => ENABLE_MS ? 'http://phototask-channel-ms.360in.com' : 'http://127.0.0.1:8009',
                'task'      => ENABLE_MS ? 'http://phototask-task-ms.360in.com' : 'http://127.0.0.1:8009',
                'discover'  => ENABLE_MS ? 'http://phototask-discover-ms.360in.com' : 'http://127.0.0.1:8009',
                'user'      => ENABLE_MS ? 'http://phototask-user-ms.360in.com' : 'http://127.0.0.1:8009',
                'feed'      => ENABLE_MS ? 'http://phototask-feed-ms.360in.com' : 'http://127.0.0.1:8009',
                'comment'   => ENABLE_MS ? 'http://phototask-comment-ms.360in.com' : 'http://127.0.0.1:8009',
                'rec'       => ENABLE_MS ? 'http://phototask-rec-ms.360in.com' : 'http://127.0.0.1:8009',
                'translate' => ENABLE_MS ? 'http://phototask-translate-ms.360in.com' : 'http://127.0.0.1:8009',
                'msg'       => ENABLE_MS ? 'http://phototask-msg-ms.360in.com' : 'http://127.0.0.1:8009',
                'emotion'   => ENABLE_MS ? 'http://phototask-emotion-ms.360in.com' : 'http://127.0.0.1:8009',
                'manage'    => ENABLE_MS ? 'http://phototask-manage-ms.360in.com' : 'http://127.0.0.1:8009',
                'share'     => ENABLE_MS ? 'http://phototask-share-ms.360in.com'  : 'http://127.0.0.1:8009',
                'mqBridge'  => ENABLE_MS ? 'http://phototask-mqbridge-ms.360in.com' : 'http://127.0.0.1:8009',
                'report'    => ENABLE_MS ? 'http://phototask-report-ms.360in.com' : 'http://127.0.0.1:8009',
                'music'     => ENABLE_MS ? 'http://phototask-music-ms.360in.com' : 'http://127.0.0.1:8009',
            ),
            'innerUrl' => 'http://phototask-inner.360in.com',
            'recServHost' => 'http://rec-inner.360in.com',       // 推荐服务
            'tagServHost' => 'https://tagapi.camera360.com',    // 标签服务
            //'censorHost' => 'https://anti.camera360.com',  // 审核服务
            'censorHost' => 'http://anti-inner.360in.com',  // 审核服务
            'censorBack' => 'http://phototask-inner.360in.com/manage/inner/reportInner/censorBack',      // 审核服务回调地址
            'commentCensorBack' => 'http://phototask-inner.360in.com/manage/inner/reportInner/commentCensorBack',      // 审核服务回调地址
            'antiBack' => 'http://phototask-inner.360in.com/manage/inner/reportInner/antiBack',          // 鉴黄服务回调地址
            'commentAntiBack' => 'http://phototask-inner.360in.com/manage/inner/reportInner/commentAntiBack',          // 评论鉴黄服务回调地址
            'member' => array(
                'innerHost' => 'http://member-inner.360in.com',
            ),
            'awsS3Log' => array(
                'key' => 'onlinelog/#YM#/#D#/photoTask/photoTask.notice.#YMDH#.#SERVER#',
            ),
            'awsS3Data' => array(
                'keys' => array()
            ),
            //任务详情页优秀作品的相关配置
            'niceWorks' => array(
                'ratio' => 0.5, //在已经完成初始化分发的照片的前50%中随机取照片，作为任务详情页的优秀作品
                //@todo 配置独立出来
                'workSum' => array(5, 30),    //前20%的照片中随机取一定范围张照片
                'criticalVal' => 50,          //第一个状态到第二状态的临界值
                'beingMax' => 300,            //第二状态显示照片的最大数量
            ),
            //投票业务相关配置
            'vote' => array(
                'defaultDispatch' => 5, //每张照片一开始默认被分发的人数
                'leftParam_1' => 80,
                'leftParam_2' => 100,
                'denominatorParam' => 100,
                'n1' => - 2.45,
                'n2' => - 0.328,
                'n3' => 1.024,
                'crisis' => 3,
                'new_n' => 0.4,
                'expectAllSumVar' => 8, //计算每张照片期望投票数的参数
            ),
            'chart-service' => array(
                'service' => 'https://chart-service-test.camera360.com/snap/snap',
                'page' => 'https://phototask-api.camera360.com/pic/map',
            ),
            'robot' => array(
                'aws' => array(
                    'region' => 'ap-southeast-1',
                    'accessKeyId' => 'AKIAJGRLMSR5QTELZDNA',
                    'secretAccessKey' => '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',
                    'robotUser' => array(
                        'bucket' => 'pg-app-data',
                        'prefix' => 'robot/usercenter/production/',
                    ),
                    'robotWork' => array(
                        'bucket' => 'pg-app-data',
                        'prefix' => 'robot/photo/',
                    ),
                    'robotComment' => array(
                        'bucket' => 'pg-app-data',
                        'prefix' => 'robot/comment/',
                    ),
                    'queueUrl' => 'https://sqs.ap-southeast-1.amazonaws.com/421921736743/sns-robot-online',
                ),
                'like' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 3600,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 3600,
                            'end' => 3600 * 12,
                            'p' => 0.5,
                        ),
                    ),
                ),
                'comment' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 3600,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 3600,
                            'end' => 3600 * 12,
                            'p' => 0.5,
                        ),
                    ),
                ),
                'follow' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 3600,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 3600,
                            'end' => 3600 * 12,
                            'p' => 0.5,
                        ),
                    ),
                ),
            ),
            'mq_config' => array(
                'host' => 'http://en-ap-mq-inner.360in.com',
                'timeout' => 1,
            ),
            'cmdRedisConf' => $amzRedisWriteHosts,
            'cmdRedisConfRead' => $amzRedisReadHosts,
            'translate' => array(
                'detect' => 'microsoft', // 检测翻译器
                'translate' => 'microsoft', // 翻译翻译器
                'microsoft' => array(
                    'key' => '5f51ea432b73400286ba10ede5ae4de9',
                ),
                'switch' => array(
                    'detect' => 1, // 0：关闭；1：打开
                    'translate' => 1, // 0：关闭；1：打开
                    'nontranslatedLangs' => array( // 不翻译的语言

                    ),
                    'feature' => array( // 不翻译的功能
                        'comment' => 1, // 评论内容
                        'work' => 1,    // 作品描述
                    ),
                ),
            )
        ),
        'components' => array(
            'geo' => array(
                'class' => 'PGGeoService',
                'timeout' => 500,
                'mode' => 'production-en', // mode可以到各个环境配置下覆盖
            ),
            'geoCoder' => array( // 注意：@20160713 geoCoder不要调用，暂时不迁该服务至新加坡.
                'class' => 'PGGeoCoderService',
                'timeout' => 500,
                'mode' => 'production-en', // mode可以到各个环境配置下覆盖
            ),
            'location' => array(
                'class' => 'PGLocationService',
                'timeout' => 500,
                'mode' => 'production', // mode可以到各个环境配置下覆盖
            ),
            // 读从库
            'dbPhotoTask' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://en-ap-phototask-mongodb0:28110,en-ap-phototask-mongodb1:28111,en-ap-phototask-mongodb2:28112,en-ap-phototask-mongodb3:28113,en-ap-phototask-mongodb4:28114,en-ap-phototask-mongodb5:28115,en-ap-phototask-mongodb6:28116',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST,MongoClient::RP_PRIMARY,//
                    //'connectTimeoutMS' => 1000,
                    'connectTimeoutMS' => 50, // 跨机房写时时间要设长.
                    'replicaSet' => 'phototask_rs1',
                ),
            ),
            //msg
            'dbPhotoTaskMsg' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://en-ap-phototask-mongodb7:28117,en-ap-phototask-mongodb8:28118,en-ap-phototask-mongodb9:28119',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST,MongoClient::RP_PRIMARY,//
                    //'connectTimeoutMS' => 1000,
                    'connectTimeoutMS' => 50, // 跨机房写时时间要设长.
                    'replicaSet'  => 'phototask_msg_rs1',
                ),
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    'file' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error,warning',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'notice' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'notice',
                        'logFile' => 'notice.log',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'recommend' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'info',
                        'logFile' => 'recommend.log',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'profile' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'profile',
                        'logFile' => 'profile.log',
                        'maxFileSize' => 100 * 1024,
                        'maxLogFiles' => 100,
                    ),
                ),
            ),
        ),
    )
);

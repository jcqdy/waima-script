<?php
//redis缓存配置
$pgRedisHosts = array(
    array('host' => '127.0.0.1', 'port' => 6379),
);
$amzRedisWriteHosts = $pgRedisHosts;
$amzRedisReadHosts = $pgRedisHosts;
return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(
            'picHost' => 'http://phototask.c360dn.com/',
            'ssoUser' => array(
                'host'      => 'http://itest.camera360.com',
                'appkey'    => 'fd8463e40988de06', // change to your appkey
                'appsecret' => '825b682ffd8463e40988de0695328954', // change to your appsecret
            ),
            'qboxCallbackHost' => 'http://phototask-test.360in.com',
            'innerHost' => 'http://127.0.0.1:8009',
            'innerUrl' => 'http://127.0.0.1:8009',
            'recServHost' => 'https://rec-dev.camera360.com',       // 推荐服务
            'tagServHost' => 'https://tagapi-dev.camera360.com',    // 标签服务
            'censorHost' => 'https://censor-dev.camera360.com',      // 审核服务
            'censorBack' => 'http://phototask-test.360in.com/manage/inner/reportInner/censorBack',      // 审核服务回调地址
            'commentCensorBack' => 'http://phototask-test.360in.com/manage/inner/reportInner/commentCensorBack',      // 审核服务回调地址
            'antiBack' => 'http://phototask-test.360in.com/manage/inner/reportInner/antiBack',          // 鉴黄服务回调地址
            'commentAntiBack' => 'http://phototask-test.360in.com/manage/inner/reportInner/commentAntiBack',          // 评论鉴黄服务回调地址
            'member' => array(
                'innerHost' => '127.0.0.1:8070',
            ),
            'awsS3Log' => array(
                'key' => 'testingdevlog/#YM#/#D#/photoTask/photoTask.notice.#YMDH#.#SERVER#',
            ),
            'awsS3Data' => array(
                'keys' =>  array()
            ),
            //任务详情页优秀作品的相关配置
            'niceWorks' => array(
                'ratio' => 0.5, //在已经完成初始化分发的照片的前50%中随机取照片，作为任务详情页的优秀作品
                'workSum' => array(5, 30),    //前20%的照片中随机取一定范围张照片
                'criticalVal' => 50,          //第一个状态到第二状态的临界值
                'beingMax' => 300,            //第二状态显示照片的最大数量
            ),
            //投票业务相关配置
            'vote' => array(
                'defaultDispatch' => 1, //每张照片一开始默认被分发的人数
                'leftParam_1' => 80,
                'leftParam_2' => 100,
                'denominatorParam' => 100,
                'n1' => -2.45,
                'n2' => -0.328,
                'n3' => 1.024,
                'crisis' => 3,
                'new_n' => 0.4,
                'expectAllSumVar' => 8, //计算每张照片期望投票数的参数
            ),
            'chart-service' => array(
                'service' => 'http://chart-service-test.camera360.com/snap/snap',
                'page' => 'http://phototask-test.360in.com/pic/map',
            ),
            'robot' => array(
                'workLimit' => 1,
                'aws' => array(
//                     'queueUrl' => 'https://sqs.cn-north-1.amazonaws.com.cn/966062645859/sns-robot-testing-dev',
//                     'robotUser' => array(
//                         'prefix' => 'robot/usercenter/testing/',
//                     ),
                ),
                'like' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 120,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 120,
                            'end' => 3600*12,
                            'p' => 0.5,
                        ),
                    ),
                ),
                'comment' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 120,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 120,
                            'end' => 3600*12,
                            'p' => 0.5,
                        ),
                    ),
                ),
                'follow' => array(
                    'region' => array(
                        array(
                            'begin' => 60,
                            'end' => 120,
                            'p' => 0.5,
                        ),
                        array(
                            'begin' => 120,
                            'end' => 3600*12,
                            'p' => 0.5,
                        ),
                    ),
                ),
            ),
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
                'class'=>'PGGeoService',
                'timeout' => 500,
                'mode' => 'production-en', //mode可以到各个环境配置下覆盖
            ),
            'geoCoder' => array( // 注意：@20160713 geoCoder不要调用，暂时不迁该服务至新加坡.
                'class'=>'PGGeoCoderService',
                'timeout' => 500,
                'mode' => 'production-en', //mode可以到各个环境配置下覆盖
            ),
            'location' => array(
                'class'=>'PGLocationService',
                'timeout' => 500,
                'mode' => 'production-en', //mode可以到各个环境配置下覆盖
            ),
            //读从库
            'dbPhotoTask' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:27017',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
            'dbPhotoTaskMsg' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:27017',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
        ),
    )
);


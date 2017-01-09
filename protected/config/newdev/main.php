<?php
// 微服务架构是否生效
defined('ENABLE_MS') or define('ENABLE_MS', false);

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
            'pushHost' => 'http://pushmsgtest.camera360.com',
            'ssoUser' => array(
                'host'      => 'http://itest.camera360.com',
                'appkey'    => 'fd8463e40988de06', // change to your appkey
                'appsecret' => '825b682ffd8463e40988de0695328954', // change to your appsecret
            ),
            'innerHost' => 'http://127.0.0.1:8009',
            'recServHost' => 'https://rec-dev.camera360.com',       // 推荐服务
            'tagServHost' => 'https://tagapi-dev.camera360.com',    // 标签服务
            //http://127.0.0.1:8009',
            'member' => array(
                'innerHost' => '54.222.152.13:8070',
            ),
            'awsS3Log' => array(
                'key' => 'testingdevlog/#YM#/#D#/photoTask/photoTask.notice.#YMDH#.#SERVER#',
            ),
            'awsS3Data' => array(
                'keys' =>  array()
            ),
            'robot' => array(
                'aws' => array(
                    'queueUrl' => 'https://sqs.cn-north-1.amazonaws.com.cn/966062645859/sns-robot-testing-dev',
                    'region' => 'ap-southeast-1',
                    'accessKeyId' => 'AKIAJGRLMSR5QTELZDNA',
                    'secretAccessKey' => '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',
                    'robotUser' => array(
                        'prefix' => 'robot/usercenter/testing/',
                    ),
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
            'mq_config' => array(
                'host' => 'http://127.0.0.1:8002',
                'timeout' => 1,
            ),
            'apiAccessLimit' => array(
//                'user.profilelist' => array(
//                    'rate' => 10,
//                    'method' => 'defaultProfile'
//                ),
//                'user.profile' => array(
//                    'rate' => 10,
//                ),
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
                'mode' => 'develop', //mode可以到各个环境配置下覆盖
            ),
            'geoCoder' => array( // 注意：@20160713 geoCoder不要调用，暂时不迁该服务至新加坡.
                'class'=>'PGGeoCoderService',
                'timeout' => 500,
                'mode' => 'develop', //mode可以到各个环境配置下覆盖
            ),
            'location' => array(
                'class'=>'PGLocationService',
                'timeout' => 500,
                'mode' => 'develop', //mode可以到各个环境配置下覆盖
            ),
            'dbPhotoTask' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:27017',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//RP_SECONDARY_PREFERRED,//MongoClient::RP_PRIMARY,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
            'dbPhotoTaskMsg' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:27017',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//RP_SECONDARY_PREFERRED,//MongoClient::RP_PRIMARY,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
        ),
    )
);

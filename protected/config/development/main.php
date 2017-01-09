<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(
            'picHost' => 'http://phototask.c360dn.com/',
            'ssoUser' => array(
                'host'      => 'http://itest.camera360.com',
                'appkey'    => 'c893aff538416202d9a1', // change to your appkey
                'appsecret' => 'bff769a76895aee8eff7fa10a5e6502f', // change to your appsecret
            ),
            'awsS3Log' => array(
                'key' => 'testingdevlog/#YM#/#D#/photoTask/photoTask.notice.#YMDH#.#SERVER#',
            ),
            'awsS3Data' => array(
                'keys' =>  array()
            ),
            'recServHost' => 'https://rec-dev.camera360.com',
            'robot' => array(
                'aws' => array(
                    'queueUrl' => 'https://sqs.cn-north-1.amazonaws.com.cn/966062645859/sns-robot-testing-dev',
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
    )
);

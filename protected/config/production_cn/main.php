<?php
//require_once(dirname(__FILE__) . '/../../../../config/configparser.php');
//pg redis hosts

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(
            'wechat' => array(
                'getAccTokenUrl' => 'https://api.weixin.qq.com/cgi-bin/token',
                'appId' => 'wx8721cee23d00aae3',
                'appSecret' => 'd4e5c8cb9fb74ca68ce951d3435da6f2',
            ),
        ),
        'components' => array(
            //读从库
            'dbOp' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:28110',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//,RP_NEAREST,MongoClient::RP_PRIMARY,//
                    //'connectTimeoutMS' => 1000,
                    'connectTimeoutMS' => 3000, // 切主后，跨机房写时时间要设长.
//                    'replicaSet'  => 'phototask_rs1',
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
                        'levels' => 'notice,trace',
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

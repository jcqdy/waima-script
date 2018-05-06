<?php
//require_once(dirname(__FILE__) . '/../../../../config/configparser.php');
//pg redis hosts

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(),
        'components' => array(
            'dbwaima-script' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:28111',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,//MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST
                    'connectTimeoutMS' => 1000,
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

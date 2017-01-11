<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'name' => 'My Console Application',
        //脚本机日志级别处理
        'components' => array(
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
                        'levels' => 'notice,trace,info',
                        'logFile' => 'notice.log',
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

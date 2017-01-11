<?php
// 微服务架构是否生效
defined('ENABLE_MS') or define('ENABLE_MS', true);

//redis缓存配置
$pgRedisHosts = array(
    array('host' => '172.31.10.183', 'port' => 6380),
);
$amzRedisWriteHosts = $pgRedisHosts;
$amzRedisReadHosts = $pgRedisHosts;
return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(),
        'components' => array(
            //读从库
            'dbPhotoTask' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:28111',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,// MongoClient::RP_SECONDARY_PREFERRED,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
            'dbPhotoTaskMsg' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://127.0.0.1:28111',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_PRIMARY,// MongoClient::RP_SECONDARY_PREFERRED,RP_NEAREST
                    'connectTimeoutMS' => 1000,
                ),
            ),
        ),
    )
);

<?php

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
        ),
    )
);

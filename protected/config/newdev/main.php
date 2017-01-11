<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params'=>array(),
        'components' => array(
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

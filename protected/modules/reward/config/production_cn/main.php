<?php

$conf = require realpath(dirname(__FILE__) . '/../../../../config/production_cn/main.php');
return CMap::mergeArray(
    require(__DIR__ . '/../base.php'),
    array(
        'components' => array(),
        'params' => array(),
    )
);

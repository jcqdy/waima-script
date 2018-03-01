<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'components'=>array(),
        'params' => array(),
    )
);

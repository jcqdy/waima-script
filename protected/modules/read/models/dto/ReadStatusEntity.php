<?php
class ReadStatusEntity
{
    public $readStatus;

    public $script;

    public function __construct($readStatus, $scriptItems)
    {
        $this->readStatus['fontSize'] = isset($readStatus['fontSize']) ? $readStatus['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->readStatus['backColor'] = isset($readStatus['backColor']) ? $readStatus['backColor'] : CommonConst::DEFAULT_READ_POS;

        $this->script = $scriptItems;
    }
}

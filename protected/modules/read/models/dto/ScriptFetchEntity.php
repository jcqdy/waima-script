<?php

class ScriptFetchEntity
{
    public $readStatus = [];

    public $script = [];

    public function __construct($readStatus, $script, $inBookCase, $status)
    {
        $this->readStatus['fontSize'] = isset($readStatus['fontSize']) ? $readStatus['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->readStatus['backColor'] = isset($readStatus['backColor']) ? $readStatus['backColor'] : CommonConst::DEFAULT_READ_POS;

        $this->script = new ScriptEntity($script);
        $this->script->readPos = isset($status['readPos']) ? $status['readPos'] : 0;
        $this->script->inBookCase = $inBookCase;
    }
}

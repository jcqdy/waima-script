<?php

class ScriptFetchEntity
{
    public $readStatus = [];

    public $script = [];

    public function __construct($readStatus, $script, $inBookCase, $status, $note)
    {
        $this->readStatus['fontSize'] = isset($readStatus['fontSize']) ? $readStatus['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->readStatus['backColor'] = isset($readStatus['backColor']) ? $readStatus['backColor'] : CommonConst::DEFAULT_READ_POS;

        $this->script = new ScriptEntity($script);
        $this->script->readPos = isset($status['readPos']) ? $status['readPos'] : 0;
        $this->script->inBookCase = $inBookCase;
        if (empty($note))
            $this->script->noteMark = [];

        $this->script['noteMark']['noteId'] = isset($note['_id']) ? (string)$note['_id'] : '';
        $this->script['noteMark']['markId'] = isset($note['markId']) ? $note['markId'] : [];
        $this->script['noteMark']['note'] = isset($note['note']) ? (string)$note['note'] : '';
    }
}

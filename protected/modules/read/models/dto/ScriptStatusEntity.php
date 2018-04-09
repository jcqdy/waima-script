<?php

class ScriptStatusEntity
{
    public $scriptId;

    public $readPos;

    public $inBookCase;

    public $noteMark = [];

    public function __construct($id, $noteList, $inBookCase, $statList, $script)
    {
        $scriptEntity = new ScriptEntity($script);
        foreach ($scriptEntity as $key => $val) {
            $this->$key = $val;
        }

        $this->readPos = isset($statList['readPos']) ? $statList['readPos'] : CommonConst::DEFAULT_READ_POS;
        $this->inBookCase = $inBookCase;

        foreach ($noteList as $note) {
            $item = [];
            $item['noteId'] = isset($note['_id']) ? (string)$note['_id'] : '';
//            $item['markPos'] = isset($note['markPos']) ? $note['markPos'] : [];
            $item['markId'] = isset($note['markId']) ? $note['markId'] : [];
            $item['note'] = isset($note['note']) ? (string)$note['note'] : '';
            $this->noteMark[] = $item;
        }
    }
}

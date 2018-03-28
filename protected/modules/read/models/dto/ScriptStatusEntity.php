<?php

class ScriptStatusEntity
{
    public $scriptId;

    public $readPos;

    public $inBookCase;

    public $noteMark = [];

    public function __construct($id, $noteList, $inBookCase, $statList)
    {
        $this->scriptId = (string)$id;
        $this->readPos = isset($statList['readPos']) ? $statList['readPos'] : CommonConst::DEFAULT_READ_POS;
        $this->inBookCase = $inBookCase;

        foreach ($noteList as $note) {
            $item = [];
            $item['noteId'] = isset($note['_id']) ? (string)$note['_id'] : '';
//            $item['markPos'] = isset($note['markPos']) ? $note['markPos'] : [];
            $item['markId'] = isset($note['markId']) ? $note['markId'] : [];
            $this->noteMark[] = $item;
        }
    }
}

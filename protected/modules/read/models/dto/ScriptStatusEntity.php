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
            $item['pkgId'] = isset($note['pkgId']) ? (string)$note['pkgId'] : '';
            $item['createTime'] = isset($note['createTime']) ? $note['createTime'] : time();
            $date = isset($note['createTime']) ? explode(':', date('Y:m:d', $note['createTime'])) : explode(':', date('Y:m:d', time()));
            $item['year'] = $date[0];
            $item['mon'] = $date[1];
            $item['day'] = $date[2];

            $this->noteMark[] = $item;
        }
    }
}

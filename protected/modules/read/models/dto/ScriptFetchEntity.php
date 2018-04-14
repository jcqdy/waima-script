<?php

class ScriptFetchEntity
{
    public $readStatus = [];

    public $script = [];

    public function __construct($readStatus, $script, $inBookCase, $status, $notes)
    {
        $this->readStatus['fontSize'] = isset($readStatus['fontSize']) ? $readStatus['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->readStatus['backColor'] = isset($readStatus['backColor']) ? $readStatus['backColor'] : CommonConst::DEFAULT_READ_POS;

        $this->script = new ScriptEntity($script);
        $this->script->readPos = isset($status['readPos']) ? $status['readPos'] : 0;
        $this->script->inBookCase = $inBookCase;

        $this->script->noteMark = [];

        if (! empty($notes)) {
            foreach ($notes as $note) {
                $item = [];
                $item['noteId'] = isset($note['_id']) ? (string)$note['_id'] : '';
                $item['markId'] = isset($note['markId']) ? $note['markId'] : [];
                $item['note'] = isset($note['note']) ? (string)$note['note'] : '';
                $item['pkgId'] = isset($note['pkgId']) ? (string)$note['pkgId'] : '';
                $item['createTime'] = isset($note['createTime']) ? $note['createTime'] : time();
                $date = isset($note['createTime']) ? explode(':', date('Y:m:d', $note['createTime'])) : explode(':', date('Y:m:d', time()));
                $item['year'] = $date[0];
                $item['mon'] = $date[1];
                $item['day'] = $date[2];

                $this->script->noteMark[] = $item;
            }
        }
    }
}

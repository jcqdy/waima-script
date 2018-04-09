<?php
class NoteMarkEntity
{
    public $noteId;

    public $scriptId;

    public $userId;

    public $type;

//    public $markPos;

    public $mark;

    public $markId;

    public $note;

    public $pkgId;

    public $createTime;

    public $updateTime;

    public $year;

    public $mon;

    public $day;

    public function __construct($noteMark)
    {
        $this->noteId = isset($noteMark['_id']) ? (string)$noteMark['_id'] : '';
        $this->userId = isset($noteMark['userId']) ? (string)$noteMark['userId'] : '';
        $this->scriptId = isset($noteMark['scriptId']) ? (string)$noteMark['scriptId'] : '';
//        $this->markPos = isset($noteMark['markPos']) ? $noteMark['markPos'] : [];
        $this->mark = isset($noteMark['mark']) ? $noteMark['mark'] : [];
        $this->markId = isset($noteMark['markId']) ? $noteMark['markId'] : [];
        $this->note = isset($noteMark['note']) ? (string)$noteMark['note'] : '';
        $this->pkgId = isset($noteMark['pkgId']) ? (string)$noteMark['pkgId'] : '';
        $this->createTime = isset($noteMark['createTime']) ? $noteMark['createTime'] : 0;
        $this->updateTime = isset($noteMark['updateTime']) ? $noteMark['updateTime'] : 0;
        $date = isset($noteMark['createTime']) ? explode(':', date('Y:m:d', $noteMark['createTime'])) : explode(':', date('Y:m:d', time()));
        $this->year = $date[0];
        $this->mon = $date[1];
        $this->day = $date[2];
        $this->type = isset($noteMark['type']) ? $noteMark['type'] : 1;

//        if ($noteMark['type'] === CommonConst::NOTE_TYPE) {
//            $this->noteId = isset($val['_id']) ? (string)$val['_id'] : '';
//            unset($this->markId);
//        } elseif ($noteMark['type'] === CommonConst::MARK_TYPE) {
//            $this->markId = isset($val['_id']) ? (string)$val['_id'] : '';
//            unset($this->noteId);
//        }
    }
}

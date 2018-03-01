<?php
class NoteMarkListEntity
{
    public $script;

    public $note = [];

//    public $mark = [];

    public function __construct($script, $noteMarks)
    {
        $this->script = new ScriptEntity($script);
        foreach ($noteMarks as $val) {
            $this->note[] = new NoteMarkEntity($val);

//            if ($val['type'] === CommonConst::NOTE_TYPE) {
//                $data['noteId'] = isset($val['_id']) ? (string)$val['_id'] : '';
//                $this->note[] = $data;
//            } elseif ($val['type'] === CommonConst::MARK_TYPE) {
//                $data['markId'] = isset($val['_id']) ? (string)$val['_id'] : '';
//                $this->mark[] = $data;
//            }
        }
    }
}

<?php

class ModelLogicMark
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($markId)
    {
        $ret = ['script' => [], 'note' => []];
        $note = $this->modelDataNoteMark->findNoteMark($markId);
        if (empty($note)) {
            return $ret;
        }

        $scriptId = $note['scriptId'];
        $script = $this->modelDataNoteMark->getScript($scriptId);

        $ret['script'] = new ScriptEntity($script);
        $ret['mark'] = new NoteMarkEntity($note);

        return $ret;
    }
}

<?php

class ModelLogicNote
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($noteId)
    {
        $ret = ['script' => [], 'note' => []];
        $note = $this->modelDataNoteMark->findNoteMark($noteId);
        if (empty($note)) {
            return $ret;
        }

        $scriptId = $note['scriptId'];
        $script = $this->modelDataNoteMark->getScript($scriptId);

        $ret['script'] = new ScriptEntity($script);
        $ret['note'] = new NoteMarkEntity($note);

        return $ret;
    }
}

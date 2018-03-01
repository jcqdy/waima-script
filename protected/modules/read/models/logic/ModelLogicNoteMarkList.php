<?php

class ModelLogicNoteMarkList
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($userId, $scriptId)
    {
        $script = $this->modelDataNoteMark->getScript($scriptId);
        if (empty($script))
            return [];

        $noteMarks = $this->modelDataNoteMark->getNoteMark($userId, $scriptId, 1);

        return new NoteMarkListEntity($script, $noteMarks);
    }
}

<?php

class ModelLogicNoteMarkList
{
    protected $modelDataNoteMark;

    protected $defaultRet = [
        'items' => [
            'script' => [],
            'note' => []
        ],
        'sp' => -1,
    ];

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($userId, $scriptId, $sp, $num)
    {
        $script = $this->modelDataNoteMark->getScript($scriptId);
        if (empty($script))
            throw new Exception('script is not exist', Errno::INVALID_PARAMETER);

        $noteMarks = $this->modelDataNoteMark->getNoteMark($userId, $scriptId, $sp, $num, 1);
        if (empty($noteMarks))
            return $this->defaultRet;

        $newSp = end($noteMarks)['updateTime'];
        $items = new NoteMarkListEntity($script, $noteMarks);

        return ['items' => $items, 'sp' => $newSp];
    }
}

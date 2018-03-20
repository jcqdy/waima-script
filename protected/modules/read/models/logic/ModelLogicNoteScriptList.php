<?php

class ModelLogicNoteScriptList
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($userId)
    {
        $scriptIds = $this->modelDataNoteMark->queryNoteScriptIds($userId, 1);
        if (empty($scriptIds))
            return [];

        $scripts = $this->modelDataNoteMark->queryBySids($scriptIds);
        if (empty($scripts))
            return [];

        $ret = [];
        foreach ($scripts as $script) {
            $ret[] = new ScriptEntity($script);
        }

        return $ret;
    }
}

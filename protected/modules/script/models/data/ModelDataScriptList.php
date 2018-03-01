<?php

class ModelDataScriptList
{
    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function queryScriptByTypeId($typeId, $sp, $num)
    {
        return $this->modelDaoScript->queryByTypeId($typeId, $sp, $num);
    }

    public function getHotScripts($sp, $num)
    {
        return $this->modelDaoScript->querySortByReadNum($sp, $num);
    }

    public function getNewScript($sp, $num)
    {
        return $this->modelDaoScript->querySortByCreatTime($sp, $num);
    }
}

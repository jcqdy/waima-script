<?php
class ModelDataType
{
    protected $modelDaoScriptType;

    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoScriptType = new ModelDaoScriptType();
        $this->modelDaoScript = new ModelDaoScript();
    }
    
    public function queryTypes()
    {
        return $this->modelDaoScriptType->queryAll();
    }

    public function queryScriptByTypeId($typeId, $sp, $num)
    {
        return $this->modelDaoScript->queryByTypeId($typeId, $sp, $num);
    }

    public function getType($typeId)
    {
        return $this->modelDaoScriptType->getType($typeId);
    }

    public function getHotScripts($sp, $num)
    {
        return $this->modelDaoScript->querySortByReadNum($sp, $num);
    }
}

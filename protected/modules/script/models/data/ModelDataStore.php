<?php

class ModelDataStore
{
    protected $modelDaoScriptType;

    protected $modelDaoScript;

    protected $modelDaoOperation;

    public function __construct()
    {
        $this->modelDaoScriptType = new ModelDaoScriptType();
        $this->modelDaoScript = new ModelDaoScript();
        $this->modelDaoOperation = new ModelDaoOperation();
    }

    public function getBanner()
    {
        return $this->modelDaoOperation->queryBanner();
    }

    public function queryType()
    {
        return $this->modelDaoScriptType->queryLimit();
    }

    public function getHotScripts($limit)
    {
        return $this->modelDaoScript->querySortByReadNum(0, $limit);
    }

    public function getNewScripts($limit)
    {
        return $this->modelDaoScript->querySortByCreatTime(0, $limit);
    }

    public function queryAll()
    {
        return $this->modelDaoScriptType->queryAll();
    }

}

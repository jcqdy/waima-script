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
        $this->modelDaoActive = new ModelDaoActive();
    }

    public function getBanner()
    {
        return $this->modelDaoOperation->queryBanner();
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

    public function queryByOpIds($opIds, $status)
    {
        return $this->modelDaoActive->queryByOpId($opIds, $status);
    }

    public function findScript($scriptId)
    {
        return $this->modelDaoScript->findOneScript($scriptId);
    }
}

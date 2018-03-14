<?php

class ModelDataOpScriptList
{
    protected $modelDaoOperation;

    protected $modelDaoActive;

    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoOperation = new ModelDaoOperation();
        $this->modelDaoActive = new ModelDaoActive();
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function getActive($opId)
    {
        return $this->modelDaoActive->findByOpId($opId);
    }
    
    public function queryScriptByIds($scriptIds)
    {
        return $this->modelDaoScript->queryByIds($scriptIds);
    }
}

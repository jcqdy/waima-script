<?php

class ModelDataConf
{
    protected $modelDaoOperation;

    protected $modelDaoActive;

    public function __construct()
    {
        $this->modelDaoOperation = new ModelDaoOperation();
        $this->modelDaoActive = new ModelDaoActive();
    }

    public function addOp($type, $gotoType, $resourceUrl, $sort, $createTime, $status = 1)
    {
        return $this->modelDaoOperation->addOp($type, $gotoType, $resourceUrl, $sort, $createTime, $status);
    }

    public function addActive($type, $data, $opId, $createTime, $status = 1)
    {
        return $this->modelDaoActive->addActive($type, $data, $opId, $createTime, $status);
    }
}

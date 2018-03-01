<?php

class ModelDataReadRecord
{
    protected $modelDaoReadRecord;

    protected $modelDaoUser;

    public function __construct()
    {
        $this->modelDaoReadRecord = new ModelDaoReadRecord();
        $this->modelDaoUser = new ModelDaoUser();
    }

    public function addReadRecord($userId, $scriptId, $updateTime)
    {
        return $this->modelDaoReadRecord->addRecord($userId, $scriptId, $updateTime);
    }

    public function findReadRecord($userId, $scriptId)
    {
        return $this->modelDaoReadRecord->findRecord($userId, $scriptId);
    }

    public function updateReadRecord($userId, $scriptId, $updateTime, $inc)
    {
        return $this->modelDaoReadRecord->modifyRecord($userId, $scriptId, $updateTime, $inc);
    }

    public function queryUser($userId)
    {
        return $this->modelDaoUser->findUser($userId);
    }

    public function updateRecord($userId, $readNum, $readDays, $keepReadDays, $lastReadTime, $updateTime)
    {
        return $this->modelDaoUser->updateRecord($userId, $readNum, $readDays, $keepReadDays, $lastReadTime, $updateTime);
    }
}

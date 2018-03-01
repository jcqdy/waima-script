<?php
class ModelDataRead
{
    protected $modelDaoReadStatus;

    protected $modelDaoNoteMark;
    
    public function __construct()
    {
        $this->modelDaoReadStatus = new ModelDaoReadStatus();
        $this->modelDaoNoteMark = new ModelDaoNoteMark();
    }

    public function queryReadStatus($userId, $scriptIds)
    {
        return $this->modelDaoReadStatus->queryByUidSids($userId, $scriptIds);
    }

    public function getNoteMark($userId, $scriptIds)
    {
        return $this->modelDaoNoteMark->queryByUidSid($userId, $scriptIds);
    }

    public function getReadStatus($userId, $scriptId)
    {
        return $this->modelDaoReadStatus->findByUidSid($userId, $scriptId);
    }

    public function addReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime)
    {
        return $this->modelDaoReadStatus->addReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime);
    }

    public function modifyReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime)
    {
        return $this->modelDaoReadStatus->modifyReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime);
    }
}

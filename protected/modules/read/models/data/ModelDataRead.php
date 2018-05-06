<?php
class ModelDataRead
{
    protected $modelDaoReadStatus;

    protected $modelDaoNoteMark;

    protected $modelDaoUser;
    
    public function __construct()
    {
        $this->modelDaoReadStatus = new ModelDaoReadStatus();
        $this->modelDaoNoteMark = new ModelDaoNoteMark();
        $this->modelDaoUser = new ModelDaoUser();
    }

    public function queryReadStatus($userId, $scriptIds)
    {
        return $this->modelDaoReadStatus->queryByUidSids($userId, $scriptIds);
    }

    public function getNoteMark($userId, $scriptIds)
    {
        return $this->modelDaoNoteMark->queryByUidSids($userId, $scriptIds);
    }

    public function getReadStatus($userId, $scriptId)
    {
        return $this->modelDaoReadStatus->findByUidSid($userId, $scriptId);
    }

    public function addReadStatus($userId, $scriptId, $readPos, $updateTime)
    {
        return $this->modelDaoReadStatus->addReadStatus($userId, $scriptId, $readPos, $updateTime);
    }

    public function modifyReadStatus($userId, $scriptId, $readPos, $updateTime)
    {
        return $this->modelDaoReadStatus->modifyReadStatus($userId, $scriptId, $readPos, $updateTime);
    }

    public function updateUserReadStatus($userId, $fontSize, $backColor, $updateTime)
    {
        return $this->modelDaoUser->updateReadStatus($userId, $fontSize, $backColor, $updateTime);
    }

    public function getUserReadStatus($userId)
    {
        $user = $this->modelDaoUser->findUser($userId);
        return [$user['fontSize'], $user['backColor']];
    }
}

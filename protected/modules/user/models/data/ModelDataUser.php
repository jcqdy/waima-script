<?php

class ModelDataUser
{
    protected $modelDaoUser;

    public function __construct()
    {
        $this->modelDaoUser = new ModelDaoUser();
    }

    public function addUser($nickName, $avatarUrl, $gender, $city, $province, $country, $language, $createTime)
    {
        return $this->modelDaoUser->addUser($nickName, $avatarUrl, $gender, $city, $province, $country, $language, $createTime);
    }

    public function queryUser($userId)
    {
        return $this->modelDaoUser->findUser($userId);
    }

    public function updatePhoneNum($userId, $phoneNum = null, $avatarUrl = null, $nickName = null)
    {
        return $this->modelDaoUser->updatePhoneNum($userId, $phoneNum, $avatarUrl, $nickName);
    }
}

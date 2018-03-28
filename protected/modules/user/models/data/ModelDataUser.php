<?php

class ModelDataUser
{
    protected $modelDaoUser;

    public function __construct()
    {
        $this->modelDaoUser = new ModelDaoUser();
    }

    public function addUser($userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language, $createTime)
    {
        $doc = [
            'nickName' => $nickName,
            'avatarUrl' => $avatarUrl,
            'gender' => $gender,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'language' => $language,
            'updateTime' => time(),
        ];

        return $this->modelDaoUser->updateUserInfo($userId, $doc);
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

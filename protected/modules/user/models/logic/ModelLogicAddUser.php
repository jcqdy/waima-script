<?php

class ModelLogicAddUser
{
    protected $modelDataUser;
    
    public function __construct()
    {
        $this->modelDataUser = new ModelDataUser();
    }

    public function execute($openId, $userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language)
    {
        $createTime = time();
        $user = $this->modelDataUser->addUser($userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language, $createTime);
        if ($user === false)
            throw new Exception('add user failed', Errno::FATAL);
        
        return new UserEntity($user);
    }
}

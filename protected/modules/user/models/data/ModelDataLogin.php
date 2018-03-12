<?php

class ModelDataLogin
{
    protected $modelDaoUser;

    public function __construct()
    {
        $this->modelDaoUser = new ModelDaoUser();
    }

    public function getUserByOpenId($openId)
    {
        $user = $this->modelDaoUser->findByOpenId($openId);
        if (empty($user))
            return ['openId' => $openId, 'userId' => ''];

        $user = $this->modelDaoUser->addUserId($openId);
        
        return ['openId' => $openId, 'userId' => $user['_id']];
    }
}

<?php

class ModelLogicEditUser
{
    protected $modelDataUser;

    public function __construct()
    {
        $this->modelDataUser = new ModelDataUser();
    }

    public function execute($userId, $phoneNum, $avatarUrl, $nickName)
    {
        $user = $this->modelDataUser->queryUser($userId);
        if (empty($user))
            throw new Exception('user is not exist', Errno::FATAL);

        $ret = $this->modelDataUser->updatePhoneNum($userId, $phoneNum, $avatarUrl, $nickName);
        if ($ret === false)
            throw new Exception('update phone num failed', Errno::FATAL);
    }
}

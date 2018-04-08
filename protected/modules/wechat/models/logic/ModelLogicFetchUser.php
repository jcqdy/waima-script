<?php

class ModelLogicFetchUser
{
    protected $modelDataUser;

    public function __construct()
    {
        $this->modelDataUser = new ModelDataUser();
    }

    public function execute($userId)
    {
        $user = $this->modelDataUser->queryUser($userId);
        if (empty($user)) {
            LogHelper::error('user is not exist, userId : ' . (string)$userId);
            return [];
        }

        return new UserProfileEntity($user);
    }
}

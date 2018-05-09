<?php

class ModelLogicAddUser
{
    protected $modelDataUser;
    
    public function __construct()
    {
        $this->modelDataUser = new ModelDataUser();
    }

    public function execute($userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language, $phoneNum)
    {
        $doc = [];
        if ($nickName !== '')
            $doc['nickName'] = $nickName;
        if ($avatarUrl !== '')
            $doc['avatarUrl'] = $avatarUrl;
        if ($gender !== 3)
            $doc['gender'] = $gender;
        if ($city !== '')
            $doc['city'] = $city;
        if ($province !== '')
            $doc['province'] = $province;
        if ($country !== '')
            $doc['country'] = $country;
        if ($language !== '')
            $doc['language'] = $language;
        if ($phoneNum !== '')
            $doc['phoneNum'] = $phoneNum;

        if (empty($doc))
            return [];

        $doc['updateTime'] = time();
        $user = $this->modelDataUser->addUser($userId, $doc);
        if ($user === false)
            throw new Exception('add user failed', Errno::FATAL);
        
        return [];
    }
}

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
        $doc = [];
        if (! empty($nickName))
            $doc['nickName'] = $nickName;
        if (! empty($avatarUrl))
            $doc['avatarUrl'] = $avatarUrl;
        if (! empty($gender))
            $doc['gender'] = $gender;
        if (! empty($city))
            $doc['city'] = $city;
        if (! empty($province))
            $doc['province'] = $province;
        if (! empty($country))
            $doc['country'] = $country;
        if (! empty($language))
            $doc['language'] = $language;

        if (empty($doc))
            return [];

        $doc['updateTime'] = time();
        $user = $this->modelDataUser->addUser($userId, $doc);
        if ($user === false)
            throw new Exception('add user failed', Errno::FATAL);
        
        return [];
    }
}

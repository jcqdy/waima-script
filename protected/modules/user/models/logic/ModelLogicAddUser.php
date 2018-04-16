<?php

class ModelLogicAddUser
{
    protected $modelDataUser;
    
    public function __construct()
    {
        $this->modelDataUser = new ModelDataUser();
    }

    public function execute($userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language)
    {
        $doc = [];
        if (! is_null($nickName))
            $doc['nickName'] = $nickName;
        if (! is_null($avatarUrl))
            $doc['avatarUrl'] = $avatarUrl;
        if (! is_null($gender))
            $doc['gender'] = $gender;
        if (! is_null($city))
            $doc['city'] = $city;
        if (! is_null($province))
            $doc['province'] = $province;
        if (! is_null($country))
            $doc['country'] = $country;
        if (! is_null($language))
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

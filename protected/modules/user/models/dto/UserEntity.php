<?php

class UserEntity
{
    public $userId;

    public $avatarUrl;

    public $nickName;

    public $gender;

    public $city;

    public $province;

    public $country;

    public $language;

    public function __construct($user)
    {
        $this->userId = isset($user['_id']) ? (string)$user['_id'] : '';
        $this->avatarUrl = isset($user['avatarUrl']) ? (string)$user['avatarUrl'] : '';
        $this->gender = isset($user['gender']) ? (int)$user['gender'] : CommonConst::GENDER_UNKNOWN;
        $this->city = isset($user['city']) ? (string)$user['city'] : '';
        $this->province = isset($user['province']) ? (string)$user['province'] : '';
        $this->country = isset($user['country']) ? (string)$user['country'] : '';
        $this->language = isset($user['language']) ? (string)$user['language'] : '';
        $this->nickName = isset($user['nickName']) ? (string)$user['nickName'] : '';
    }
}

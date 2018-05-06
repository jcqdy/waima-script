<?php

class UserEntity
{
    public $userId;

    public $openId;

    public $avatarUrl;

    public $nickName;

    public $gender;

    public $city;

    public $province;

    public $country;

    public $language;

    public $phoneNum;

    public $fontSize;

    public $backColor;

    public function __construct($user)
    {
        $this->userId = isset($user['_id']) ? (string)$user['_id'] : '';
        $this->openId = isset($user['openId']) ? (string)$user['openId'] : '';
        $this->avatarUrl = isset($user['avatarUrl']) ? (string)$user['avatarUrl'] : '';
        $this->gender = isset($user['gender']) ? (int)$user['gender'] : CommonConst::GENDER_UNKNOWN;
        $this->city = isset($user['city']) ? (string)$user['city'] : '';
        $this->province = isset($user['province']) ? (string)$user['province'] : '';
        $this->country = isset($user['country']) ? (string)$user['country'] : '';
        $this->language = isset($user['language']) ? (string)$user['language'] : '';
        $this->nickName = isset($user['nickName']) ? (string)$user['nickName'] : '';
        $this->phoneNum = isset($user['phoneNum']) ? (string)$user['phoneNum'] : '';
        $this->fontSize = isset($user['fontSize']) ? (string)$user['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->backColor = isset($user['backColor']) ? (string)$user['backColor'] : CommonConst::DEFAULT_BACK_COLOR;
    }
}

<?php

class ModelDaoUser extends ModelDataMongoCollection
{
    const _ID = '_id';

    const NICK_NAME = 'nickName';

    const AVATAR_URL = 'avatarUrl';

    const GENDER = 'gender';

    const CITY = 'city';

    const PROVINCE = 'province';

    const COUNTRY = 'country';

    const LANGUAGE = 'language';

    const PHONE_NUM = 'phoneNum';

    const READ_NUM = 'readNum';

    const READ_DAYS = 'readDays';

    const KEEP_READ_DAYS = 'keepReadDays';

    const LATS_READ_TIME = 'lastReadTime';

    const READ_NUM_RATIO = 'readNumRatio';

    const READ_DAY_RATIO = 'readDayRatio';

    const FONT_SIZE = 'fontSize';

    const BACK_COLOR = 'backColor';

    const CREATE_TIME = 'createTime';

    const UPDATE_TIME = 'updateTime';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'user');
    }

    public function addUser($nickName, $avatarUrl, $gender, $city, $province, $country, $language, $createTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::NICK_NAME] = $nickName;
        $doc[self::AVATAR_URL] = $avatarUrl;
        $doc[self::GENDER] = $gender;
        $doc[self::CITY] = $city;
        $doc[self::PROVINCE] = $province;
        $doc[self::COUNTRY] = $country;
        $doc[self::LANGUAGE] = $language;
        $doc[self::FONT_SIZE] = CommonConst::DEFAULT_FONT_SIZE;
        $doc[self::BACK_COLOR] = CommonConst::DEFAULT_BACK_COLOR;
        $doc[self::CREATE_TIME] = $createTime;

        $ret = $this->add($doc);
        if ($ret === false)
            return false;

        return DbWrapper::transform($doc);
    }

    public function findUser($userId)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function updateRecord($userId, $readNum, $readDays, $keepReadDays, $lastReadTime, $updateTime)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::READ_NUM] = $readNum;
        $doc[self::READ_DAYS] = $readDays;
        $doc[self::KEEP_READ_DAYS] = $keepReadDays;
        $doc[self::LATS_READ_TIME] = $lastReadTime;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->modify($query, $doc);
    }

    public function updateRatio($userId, $readNumRatio, $readDayRatio)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::READ_NUM_RATIO] = $readNumRatio;
        $doc[self::READ_DAY_RATIO] = $readDayRatio;

        return $this->modify($query, $doc);
    }

    public function updatePhoneNum($userId, $phoneNum)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::PHONE_NUM] = $phoneNum;

        return $this->modify($query, $doc);
    }

    public function updateReadStatus($userId, $fontSize, $backColor, $updateTime)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::FONT_SIZE] = $fontSize;
        $doc[self::BACK_COLOR] = $backColor;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->modify($query, $doc);
    }
}

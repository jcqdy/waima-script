<?php

class ModelDaoReadRecord extends ModelDataMongoCollection
{
    const _ID = '_id';

    const USER_ID = 'userId';

    const SCRIPT_ID = 'scriptId';

    const NUM = 'num';

    const UPDATE_TIME = 'updateTime';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'readRecord');
    }

    public function addRecord($userId, $scriptId, $updateTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $doc[self::NUM] = 1;
        $doc[self::UPDATE_TIME] = $updateTime;

        $ret = $this->add($doc);
        if ($ret === false)
            throw new Exception('add read record failed', Errno::FATAL);

        return DbWrapper::transform($doc);
    }

    public function findRecord($userId, $scriptId)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function modifyRecord($userId, $scriptId, $updateTime, $inc)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        $doc['$set'] = [
            self::UPDATE_TIME => $updateTime,
        ];
        $doc['$inc'] = [
            self::NUM => $inc,
        ];

        return $this->update($query, $doc);
    }
}

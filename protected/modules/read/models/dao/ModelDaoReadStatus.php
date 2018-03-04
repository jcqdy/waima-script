<?php
class ModelDaoReadStatus extends ModelDataMongoCollection
{
    const _ID = '_id';

    const USER_ID = 'userId';

    const SCRIPT_ID = 'scriptId';

    const READ_POS = 'readPos';

    const FONT_SIZE = 'fontSize';

    const BACK_COLOR = 'backColor';

    const UPDATE_TIME = 'updateTime';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'readStatus');
    }

    public function queryByUidSids($userId, $scriptIds)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        foreach ($scriptIds as $k => $id) {
            $scriptIds[$k] =  $id instanceof MongoId ? $id : new MongoId($id);
        }
        $query[self::SCRIPT_ID] = ['$in' => $scriptIds];

        $ret = $this->query($query);

        return DbWrapper::transform($ret);
    }

    public function deleteReadStatus($userId, $scriptId)
    {
        $criteria[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $criteria[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        return $this->delete($criteria);
    }

    public function findByUidSid($userId, $scriptId)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        $ret = $this->findOne($query);

        return DbWrapper::transform($ret);
    }

    public function addReadStatus($userId, $scriptId, $readPos, $updateTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $doc[self::READ_POS] = $readPos;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->add($doc);
    }

    public function modifyReadStatus($userId, $scriptId, $readPos, $updateTime)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        $doc[self::READ_POS] = $readPos;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->modify($query, $doc);
    }
}

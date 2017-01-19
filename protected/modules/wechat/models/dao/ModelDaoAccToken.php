<?php
class ModelDaoAccToken extends ModelDataMongoCollection
{
    const _ID = '_id';

    const ACC_TOKEN = 'accToken';

    const EXPIRE_LIMIT = 'expireLimit';

    const EXPIRE_TIME = 'expireTime';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'accToken');
    }

    public function getOne()
    {
        $ret = $this->findOne();

        return DbWrapper::transform($ret);
    }

    public function addToken($accToken, $expireLimit, $expireTime)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::ACC_TOKEN => $accToken,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
        ];

        $this->add($doc);
    }

    public function updateToken($id, $accToken, $expireLimit, $expireTime)
    {
        $query = [
            self::_ID => $id instanceof MongoId ? $id : new MongoId($id),
        ];

        $doc = [
            self::ACC_TOKEN => $accToken,
            self::EXPIRE_LIMIT => $expireLimit,
            self::EXPIRE_TIME => $expireTime,
        ];

        $this->modify($query, $doc);
    }
}

<?php

class ModelDaoScriptPart extends ModelDataMongoCollection
{
    const _ID = '_id';

    const USER_ID = 'userId';

    const SCRIPT_ID = 'scriptId';

    const PKG_ID = 'pkgId';

    const MARK_POS = 'markPos';

    const MARK = 'mark';

    const CREATE_TIME = 'createTime';

    const DEL_TIME = 'delTime';

    const STATUS = 'status';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'scriptPart');
    }

    public function addPart($scriptId, $userId, $pkgId, $markPos, $mark, $createTime)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::SCRIPT_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::PKG_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $doc[self::MARK_POS] = $markPos;
        $doc[self::MARK] = $mark;
        $doc[self::CREATE_TIME] = $createTime;
        $doc[self::STATUS] = 1;

        $ret = $this->add($doc);
        if ($ret !== false)
            return DbWrapper::transform($doc);

        return false;
    }

    public function delPart($partId, $delTime)
    {
        $query[self::_ID] = $partId instanceof MongoId ? $partId : new MongoId($partId);
        $doc[self::STATUS] = 0;
        $doc[self::DEL_TIME] = $delTime;

        return $this->modify($query, $doc);
    }

    public function getByPidUid($partId, $userId, $status)
    {
        $query[self::_ID] = $partId instanceof MongoId ? $partId : new MongoId($partId);
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::STATUS] = $status;

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function getByPartId($partId, $status)
    {
        $query[self::_ID] = $partId instanceof MongoId ? $partId : new MongoId($partId);
        $query[self::STATUS] = $status;

        $ret = $this->findOne($query);

        return DbWrapper::transform($ret);

    }
}

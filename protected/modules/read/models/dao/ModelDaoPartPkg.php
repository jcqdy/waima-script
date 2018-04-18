<?php

class ModelDaoPartPkg extends ModelDataMongoCollection
{
    const _ID = '_id';

    const USER_ID = 'userId';

    const NAME = 'name';

    const PART_NUM = 'partNum';

    const CREATE_TIME = 'createTime';

    const DEL_TIME = 'delTime';

    const UPDATE_TIME = 'updateTime';

    const STATUS = 'status';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'partPkg');
    }

    public function addPkg($pkgId, $userId, $pkgName, $createTime)
    {
        $doc[self::_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $doc[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $doc[self::NAME] = $pkgName;
        $doc[self::PART_NUM] = 0;
        $doc[self::CREATE_TIME] = $doc[self::UPDATE_TIME] = $createTime;
        $doc[self::STATUS] = 1;

        $ret = $this->add($doc);
        if ($ret !== false) {
            return DbWrapper::transform($doc);
        } else {
            return false;
        }
    }

    public function incPartNum($pkgId, $incNum, $updateTime, $status = 1)
    {
        $query[self::_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $query[self::STATUS] = $status;
        $doc['$set'] = [
            self::UPDATE_TIME => $updateTime,
        ];
        $doc['$inc'] = [
            self::PART_NUM => $incNum,
        ];

        return $this->update($query, $doc);
    }

    public function editName($pkgId, $name, $updateTime, $status = 1)
    {
        $query[self::_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $query[self::STATUS] = $status;
        $doc[self::NAME] = $name;
        $doc[self::UPDATE_TIME] = $updateTime;

        return $this->modify($query, $doc);
    }

    public function findByPkgId($pkgId, $status = 1)
    {
        $query[self::_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $query[self::STATUS] = $status;

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function queryByUserId($userId, $status = 1)
    {
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);
        $query[self::STATUS] = $status;

        $ret = $this->query($query);
        return DbWrapper::transform($ret);
    }

    public function delPkg($pkgId, $userId)
    {
        $query[self::_ID] = $pkgId instanceof MongoId ? $pkgId : new MongoId($pkgId);
        $query[self::USER_ID] = $userId instanceof MongoId ? $userId : new MongoId($userId);

        $doc[self::STATUS] = 0;

        return $this->modify($query, $doc);
    }
}

<?php

class ModelDaoActive extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TYPE = 'type';

    const DATA = 'data';

    const OP_ID = 'opId';

    const CREATE_TIME = 'createTime';

    const STATUS = 'status';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'active');
    }

    public function findByOpId($opId, $status = 1)
    {
        $query[self::OP_ID] = $opId instanceof MongoId ? $opId : new MongoId($opId);
        $query[self::STATUS] = $status;

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }

    public function queryByOpId(array $opIds, $status = 1)
    {
        $ids = [];
        foreach ($opIds as $opId) {
            $ids[] = $opId instanceof MongoId ? $opId : new MongoId($opId);
        }

        $query[self::OP_ID] = ['$in' => $ids];
        $query[self::STATUS] = $status;

        $ret = $this->query($query);

        return DbWrapper::transform($ret);
    }

    public function addActive($type, $data, $opId, $createTime, $status = 1)
    {
        $doc[self::_ID] = new MongoId();
        $doc[self::TYPE] = $type;
        $doc[self::DATA] = $data;
        $doc[self::OP_ID] = $opId instanceof MongoId ? $opId : new MongoId($opId);
        $doc[self::CREATE_TIME] = $createTime;
        $doc[self::STATUS] = $status;

        $ret = $this->add($doc);
        if ($ret == false) {
            return false;
        }

        return DbWrapper::transform($doc);
    }

}

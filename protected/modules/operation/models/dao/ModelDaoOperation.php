<?php
class ModelDaoOperation extends ModelDataMongoCollection
{
    const _ID = '_id';

    const TYPE = 'type';

    const GOTO_TYPE = 'gotoType';

    const RESOURCE_URL = 'resourceUrl';

    const SORT = 'sort';

    const CREATE_TIME = 'createTime';

    const STATUS = 'status';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'operation');
    }

    public function queryBanner()
    {
        $query[self::TYPE] = CommonConst::OP_BANNER_TYPE;
        $query[self::STATUS] = 1;

        $sort[self::SORT] = -1;

        $ret = $this->query($query, [], $sort);
        return DbWrapper::transform($ret);
    }
}

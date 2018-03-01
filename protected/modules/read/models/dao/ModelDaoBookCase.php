<?php
class ModelDaoBookCase extends ModelDataMongoCollection
{
    const _ID = '_id';

    const SCRIPT_IDS = 'scriptIds';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'bookCase');
    }

    public function getById($userId)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new mongoId($userId);

        $ret = $this->findOne($query);

        return DbWrapper::transform($ret);
    }

    /**
     * 更新用户书架里的剧本信息
     *
     * @param $userId
     * @param $data
     * @return bool
     */
    public function modifyScriptIds($userId, $data)
    {
        $query[self::_ID] = $userId instanceof MongoId ? $userId : new mongoId($userId);

        $doc[self::SCRIPT_IDS] = $data;

        $ret = $this->modify($query, $doc);

        if ($ret == false) {
            return false;
        } else {
            return true;
        }
    }
}

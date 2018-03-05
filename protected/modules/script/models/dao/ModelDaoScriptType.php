<?php

class ModelDaoScriptType extends ModelDataMongoCollection
{
    const _ID = '_id';

    const NAME = 'name';

    const E_NAME = 'eName';

    const SCRIPT_NUN = 'scriptNum';

    const COVER_URL = 'coverUrl';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'scriptType');
    }

    /**
     * 通过类型id批量获取剧本类型
     *
     * @param array $typeIds
     * @return array|float|string
     */
    public function queryByIds(array $typeIds)
    {
        $ids = [];
        foreach ($typeIds as $typeId) {
            $ids[] = $typeId instanceof MongoId ? $typeId : new MongoId($typeId);
        }

        $query[self::_ID] = ['$in' => $ids];

        $ret = $this->query($query);

        return DbWrapper::transform($ret);
    }
    
    public function queryAll()
    {
        $ret = $this->query();

        return DbWrapper::transform($ret);
    }

    public function queryLimit($limit)
    {
        $ret = $this->query([], [], [], $limit);

        return DbWrapper::transform($ret);
    }

    public function getType($typeId)
    {
        $query[self::_ID] = $typeId instanceof MongoId ? $typeId : new MongoId($typeId);

        $ret = $this->findOne($query);
        return DbWrapper::transform($ret);
    }
}

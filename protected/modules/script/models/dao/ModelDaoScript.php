<?php
class ModelDaoScript extends ModelDataMongoCollection
{
    const _ID = '_id';

    const NAME = 'name';

    const FILE_URL = 'fileUrl';

    const COVER_URL = 'coverUrl';

    const TYPE_IDS = 'typeIds';

    const READER_NUM = 'readerNum';

    const WRITER = 'writer';

    const CREATE_TIME = 'createTime';

    const QRCODE_URL = 'qrcodeUrl';

    public function __construct()
    {
        parent::__construct('dbwaima-script', 'waima-script', 'script');
    }

    /**
     * 通过剧本id批量获取剧本信息
     *
     * @param array $scriptIds
     * @return array|float|string
     */
    public function queryByIds(array $scriptIds)
    {
        $ids = [];
        foreach ($scriptIds as $id) {
            $ids[] = $id instanceof MongoId ? $id : new MongoId($id);
        }

        $query[self::_ID] = ['$in' => $ids];

        $ret = $this->query($query);

        return DbWrapper::transform($ret);
    }

    /**
     * 通过一个剧本id查找某个剧本信息
     *
     * @param $scriptId
     * @return array|float|string
     */
    public function findOneScript($scriptId)
    {
        $query[self::_ID] = $scriptId instanceof MongoId ? $scriptId : new MongoId($scriptId);

        $ret = $this->findOne($query);

        return DbWrapper::transform($ret);
    }

    public function queryByTypeIds($typeIds)
    {
        $ids = [];
        $query['$or'] = [];
        foreach ($typeIds as $id) {
            $typeId = $id instanceof MongoId ? $id : new MongoId($id);
            $query['$or'][] = [self::TYPE_IDS => ['$in' => $typeId]];
        }

        $ret = $this->query($query);
        return DbWrapper::transform($ret);
    }

    public function queryByTypeId($typeId, $skip, $limit)
    {
//        $query = [self::TYPE_IDS => ['$in' => [(string)$typeId]],];
        $query = [self::TYPE_IDS => ['$in' => [(string)$typeId]],'soldout' => ['$exists' => false]];
        $sort = [self::READER_NUM => -1];

        $ret = $this->query($query, [], $sort, $limit, $skip);
        return DbWrapper::transform($ret);
    }

    public function querySortByReadNum($skip, $limit)
    {
        $sort = [self::READER_NUM => -1];
        $query = ['soldout' => ['$exists' => false]];

        $ret = $this->query($query, [], $sort, $limit, $skip);
        return DbWrapper::transform($ret);
    }

    public function querySortByCreatTime($skip, $limit)
    {
        $query = ['soldout' => ['$exists' => false]];

        if ($skip !== 0)
            $query[self::CREATE_TIME] = ['$lt' => $skip];

        $sort = [self::CREATE_TIME => -1];

        $ret = $this->query($query, [], $sort, $limit);
        return DbWrapper::transform($ret);
    }

    public function search($keywords, $skip, $limit)
    {
        $query['$or'] = [];
        foreach ($keywords as $word) {
            $query['$or'][] = [
                self::NAME => new MongoRegex("/$word/i")
            ];
        }

        $ret = $this->query($query, [], [], $limit, $skip);
        return DbWrapper::transform($ret);
    }
}

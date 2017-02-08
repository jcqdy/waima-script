<?php
class ModelDaoReward extends ModelDataMongoCollection
{
    const _ID = '_id';

    const MONEY = 'money';

    const WORK_NAME = 'workName';

    const TYPE = 'type';

    const USER_TAG = 'userTag';                 // 分享稿酬的用户标识,真实用户:1,机器人:2

    const CREATE_TIME = 'createTime';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'reward');
    }

    /**
     * 获取所有数据的数量
     *
     * @return mixed
     */
    public function countWork()
    {
        return $this->count([]);
    }

    /**
     * 通过userTag查询一条数据
     *
     * @param $userTag
     * @return mixed
     */
//    public function findByUserTag($userTag)
//    {
//        $query = [
//            self::USER_TAG => $userTag,
//        ];
//
//        $ret = $this->findOne($query);
//
//        if ($ret !== false) {
//            DbWrapper::transform($ret);
//        }
//
//        return $ret;
//    }

    /**
     * 添加稿酬分享数据
     *
     * @param $money
     * @param $workName
     * @param $type
     * @param $userTag
     * @return array|float|string
     */
    public function addReward($money, $workName, $type, $userTag = 1)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::MONEY => $money,
            self::WORK_NAME => $workName,
            self::TYPE => $type,
            self::USER_TAG => $userTag,
            self::CREATE_TIME => time(),
        ];

        $this->add($doc);

        return DbWrapper::transform($doc);
    }

    /**
     * 通过作品名称模糊搜索
     *
     * @param $workName
     * @return mixed
     */
    public function queryByWorkName($workName)
    {
        $query = [
            self::WORK_NAME => new MongoRegex("/$workName/"),
        ];

        $ret = $this->query($query);

        if ($ret !== false) {
            DbWrapper::transform($ret);
        }

        return $ret;
    }

    /**
     * 通过创建时间查询
     *
     * @param $order
     * @param $limit
     * @return mixed
     */
    public function queryByCreateTime($userTag, $order, $limit)
    {
        $query = [
            self::USER_TAG => $userTag,
        ];

        $sort = [
            self::CREATE_TIME => $order,
        ];

        $ret = $this->query($query, [], $sort, $limit);

        if ($ret !== false) {
            DbWrapper::transform($ret);
        }

        return $ret;
    }

    public function randByUserTag($userTag)
    {
        $query = [
            self::USER_TAG => $userTag,
        ];

        $data = $this->query($query);
        if (empty($data)) {
            return [];
        }

        $ret = [];
        $randKeys = array_rand($data, 2);
        foreach ($randKeys as $k) {
            $ret[] = $data[$k];
        }

        return DbWrapper::transform($ret);
    }

}

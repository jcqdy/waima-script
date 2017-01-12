<?php
class ModelDaoStat extends ModelDataMongoCollection
{
    const _ID = '_id';

    const STAT_TYPE = 'statType';
    
    const PAGE_TYPE = 'pageType';
    
    const COUNT = 'count';
    
    const SHARE_NUM = 'shareNum';

    public function __construct()
    {
        parent::__construct('dbOp', 'op', 'discoverRec');
    }

    /**
     * 查询总共有多少用户分享稿酬
     *
     * @return mixed
     */
    public function findShareSum()
    {
        $query = [
            self::STAT_TYPE => 'share',
        ];

        $ret = $this->findOne($query);

        if ($ret !== false) {
            DbWrapper::transform($ret);
        }

        return $ret;
    }

    /**
     * 稿酬分享次数加1
     */
    public function incShareNum()
    {
        $query = [
            self::STAT_TYPE => 'share',
        ];

        $doc = [
            '$inc' => [
                self::SHARE_NUM => 1,
            ],
        ];

        $this->update($query, $doc);
    }

    /**
     * 添加第一次稿酬分享
     *
     * @param $shareNum
     */
    public function addShareNum($shareNum)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::STAT_TYPE => 'share',
            self::SHARE_NUM => $shareNum,
        ];

        $this->add($doc);
    }

    /**
     * 查找页面的pv
     *
     * @param $page
     * @return mixed
     */
    public function findByStatType($page, $statType)
    {
        $query = [
            self::STAT_TYPE => $statType,
            self::PAGE_TYPE => $page,
        ];

        $ret = $this->findOne($query);

        if ($ret !== false) {
            DbWrapper::transform($ret);
        }

        return $ret;
    }

    public function addPageStat($page, $statType)
    {
        $doc = [
            self::_ID => new MongoId(),
            self::STAT_TYPE => $statType,
            self::PAGE_TYPE => $page,
            self::COUNT => 1,
        ];

        $this->add($doc);
    }

    /**
     * 页面PV加一
     *
     * @param $page
     */
    public function incPageStat($page, $statType)
    {
        $query = [
            self::STAT_TYPE => $statType,
            self::PAGE_TYPE => $page,
        ];

        $doc = [
            '$inc' => [
                self::COUNT => 1,
            ],
        ];

        $this->update($query, $doc);
    }
}

<?php
class ModelLogicReward
{
    protected $modelDaoReward;

    protected $modelDaoStat;

    const TIME_SEED = 1483977600;

    const SHARE_RATION = 10;

    public function __construct()
    {
        $this->modelDaoReward = new ModelDaoReward();
        $this->modelDaoStat = new ModelDaoStat();
    }

    public function guide()
    {
        $shareNum = $this->modelDaoStat->findShareSum();

        $count = empty($shareNum) ? 0 : $shareNum['shareNum'];
        $count = $count * self::SHARE_RATION + rand(0, 9);

//        $data = $this->modelDaoReward->findByUserTag($userTag);

        return [
            'count' => $count,
//            'isShare' => empty($data) ? 0 : 1,
        ];
    }

    public function submit($workName, $type, $money)
    {
        $this->modelDaoReward->addReward($money, $workName, $type);
        $data = $this->modelDaoStat->findShareSum();

        // 判断是不是第一次有编剧分享稿酬,并计数加1
        empty($data) ? $this->modelDaoStat->addShareNum(1) : $this->modelDaoStat->incShareNum();

        return true;
    }

    public function search($workName)
    {
        $list = $this->modelDaoReward->queryByWorkName($workName);

        $dataList = $ret = [];
        foreach ($list as $data) {
            $key = $data['workName'] . '_&' . $data['type'];
            $dataList[$key][] = $data;
        }

        foreach ($dataList as $key => $data) {
            $items = [];
            $shareNum = count($data);
            $arr = explode('_&', $key);
            $type = $arr[1];
            $workName = $arr[0];

            foreach ($data as $val) {
                if (in_array($val['money'], $items)) {
                    $items[$val['money']]['num']++;
                } else {
                    $items[$val['money']] = ['money' => $val['money'], 'num' => 1];
                }
            }

            $ret[] = [
                'workName' => $workName,
                'shareNum' => $shareNum,
                'type' => $type,
                'items' => array_values($items),
            ];
        }

        return $ret;
    }

    public function stat($page, $type)
    {
        $data = $this->modelDaoStat->findByStatType($page, $type);
        if (empty($data)) {
            $this->modelDaoStat->addPageStat($page, $type);
        } else {
            $this->modelDaoStat->incPageStat($page, $type);
        }
    }

    public function newShare()
    {
        $data = $this->modelDaoReward->queryByCreateTime(1, -1, 2);
        $time = time();
        $data = array_values($data);

        $mock = false;
        // 如果最近一次用户分享距离现在大于2小时
        if ($time - $data[0]['createTime'] > 7200) {
            $data = $this->modelDaoReward->randByUserTag(2);
            $mock = true;
        }

        $ret = [];
        foreach ($data as $k => $v) {
            $item = [
                'workName' => $v['workName'],
                'money' => $v['money'],
                'type' => $v['type'],
            ];

            $lag = $mock == false ? round(($time - $v['createTime']) / 60) : rand(1, 90);
            $con = $lag >= 60 ? round($lag / 60) . '小时前' : $lag . '分钟前';

            $item['time'] = $con;

            $ret[] = $item;
        }

        return $ret;
    }
}

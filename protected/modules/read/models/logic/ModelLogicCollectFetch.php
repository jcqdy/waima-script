<?php

class ModelLogicCollectFetch
{
    protected $modelDataCollect;

    protected $defaultRet = [
        'items' => [
            'package' => [],
            'note' => []
        ],
        'sp' => -1,
    ];

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $pkgId, $sp, $num)
    {
        $pkg = $this->modelDataCollect->getPkgByPid($pkgId, $status = 1);
        if (empty($pkg))
            return $this->defaultRet;

        if ($pkg['userId'] != $userId)
            throw new Exception('userId is wrong', Errno::INVALID_PARAMETER);

        $collects = $this->modelDataCollect->queryCollectList($pkgId, $sp, $num);

        $newSp = empty($collect) ? -1 : end($collects)['updateTime'];

        $scriptIds = [];
        foreach ($collects as $collect) {
            if (! in_array($collect['scriptId'], $scriptIds))
                $scriptIds[] = $collect['scriptId'];
        }

        if (! empty($scriptIds)) {
            $scripts = $this->modelDataCollect->queryScripts($scriptIds);
        } else {
            $scripts = [];
        }

        $items = new CollectListEntity($pkg, $scripts, $collects);

        return ['items' => $items, 'sp' => $newSp];
    }
}

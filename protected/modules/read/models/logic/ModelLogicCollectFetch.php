<?php

class ModelLogicCollectFetch
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $pkgId)
    {
        $pkg = $this->modelDataCollect->getPkgByPid($pkgId, $status = 1);
        if (empty($pkg))
            return ['package' => [], 'note' => []];

        if ($pkg['userId'] !== $userId)

        $collects = $this->modelDataCollect->queryCollectList($pkgId, 1);
        if (empty($collects))
            return ['package' => [], 'note' => []];

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

        return new CollectListEntity($pkg, $scripts, $collects);
    }
}

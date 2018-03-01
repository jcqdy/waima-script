<?php

class ModelLogicPkgList
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId)
    {
        $pkgList = $this->modelDataCollect->queryPkgList($userId);
        if (empty($pkgList))
            return [];

        $ret = [];
        foreach ($pkgList as $pkg) {
            $ret[] = new PartPkgEntity($pkg);
        }

        return $ret;
    }
}

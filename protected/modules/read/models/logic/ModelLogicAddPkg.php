<?php

class ModelLogicAddPkg
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $pkgName)
    {
        $createTime = time();
        $pkgId = new MongoId();
        $ret = $this->modelDataCollect->addPkg($pkgId, $userId, $pkgName, $createTime);
        if ($ret == false)
            throw new Exception('add part package failed', Errno::FATAL);

        return new PartPkgEntity($ret);
    }
}

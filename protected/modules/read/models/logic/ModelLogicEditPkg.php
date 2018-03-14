<?php

class ModelLogicEditPkg
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $pkgId, $pkgName)
    {
        $pkg = $this->modelDataCollect->getPkgByPid($pkgId);
        if (empty($pkg))
            throw new Exception('package is not exist', Errno::PARAMETER_VALIDATION_FAILED);

        if ($pkg['userId'] != $userId)
            throw new Exception('userId is wrong', Errno::PARAMETER_VALIDATION_FAILED);

        $updateTime = time();
        $ret = $this->modelDataCollect->editPkg($pkgId, $pkgName, $updateTime);
        if ($ret === false)
            throw new Exception('edit package failed', Errno::FATAL);
    }
}

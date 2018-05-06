<?php

class ModelLogicDelPkg
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $pkgId)
    {
        $notes = $this->modelDataCollect->queryAllByPkgId($pkgId, $userId);

        if (! empty($notes)) {
            $noteIs = array_keys($notes);

            $ret = $this->modelDataCollect->updatePkgIdBatch($noteIs, $userId, $pkgId);
            if ($ret === false)
                throw new Exception('update pkgId failed', Errno::FATAL);
        }

        $ret = $this->modelDataCollect->delPkg($pkgId, $userId);
        if ($ret === false)
            throw new Exception('delete part package failed', Errno::FATAL);

        return;
    }
}

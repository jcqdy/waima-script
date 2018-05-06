<?php
class ModelLogicDelCollect
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($userId, $noteId, $pkgId)
    {
        $updateTime = time();
//        $ret = $this->modelDataCollect->delPart($partId, $delTime);
//        if ($ret === false)
//            throw new Exception('delete collect failed, partId : ' . $partId, Errno::FATAL);


        $ret = $this->modelDataCollect->updateNotePkgId($noteId, '');
        if ($ret === false)
            throw new Exception('update note pkgId failed', Errno::FATAL);

        $pkg = $this->modelDataCollect->getPkgByPid($pkgId);
        if (empty($pkg))
            return;

        if ($pkg['partNum'] > 0) {
            $ret = $this->modelDataCollect->incPartNum($pkgId, -1, $updateTime);
            if ($ret === false)
                LogHelper::error('inc partNum failed, pkgId : ' . $pkgId, 'read');
        }
        
//        $pkg = $this->modelDataCollect->getPkgByPid($pkgId);
//        if ($pkg['partNum'] <= 0) {
//            $ret = $this->modelDataCollect->delPkg($pkgId);
//            if ($ret === false)
//                LogHelper::error('delete part package failed, pkgId : ' . $pkgId, Errno::FATAL);
//
//            return;
//        }

    }
}
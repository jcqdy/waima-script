<?php
class ModelLogicAddCollect
{
    protected $modelDataCollect;

    public function __construct()
    {
        $this->modelDataCollect = new ModelDataCollect();
    }

    public function execute($pkgId, $noteId)
    {
        $updateTime = time();

//        $ret = $this->modelDataCollect->addPart($scriptId, $userId, $pkgId, $markPos, $mark, $createTime);
//        if ($ret === false)
//            throw new Exception('add collect failed', Errno::FATAL);

        $package = $this->modelDataCollect->getPkgByPid($pkgId);
        if (empty($package))
            throw new Exception('package is not exist', Errno::INVALID_PARAMETER);

        $note = $this->modelDataCollect->getNoteMark($noteId);
        if (empty($note))
            throw new Exception('note is not exist', Errno::INVALID_PARAMETER);
        if ($note['pkgId'] === $pkgId)
            return;

        $ret = $this->modelDataCollect->updateNotePkgId($noteId, $pkgId, $status = 1);
        if ($ret === false)
            throw new Exception('update note pkgId failed', Errno::FATAL);

        $ret = $this->modelDataCollect->incPartNum($pkgId, 1, $updateTime);
        if ($ret === false)
            LogHelper::error('inc partNum failed, pkgId : ' . (string)$pkgId, 'read');
    }


}

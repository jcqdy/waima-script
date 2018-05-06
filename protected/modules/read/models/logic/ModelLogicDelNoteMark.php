<?php
class ModelLogicDelNoteMark
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($noteId, $userId)
    {
        $note = $this->modelDataNoteMark->findNoteMark($noteId);
        if (empty($note))
            return;

        $ret = $this->modelDataNoteMark->deleteNoteMark($noteId);
        if ($ret == false)
            throw new Exception('del noteMark failed', Errno::FATAL);

        if (empty($note['pkgId']))
            return;

        $updateTime = time();
        $ret = $this->modelDataNoteMark->incPartNum($note['pkgId'], -1, $updateTime);
        if ($ret === false)
            LogHelper::error('inc partNum failed, pkgId : ' . $note['pkgId'], 'read');


        $pkg = $this->modelDataNoteMark->getPkgByPid($note['pkgId']);
        if ($pkg['partNum'] <= 0) {
            $ret = $this->modelDataNoteMark->delPkg($note['pkgId'], $userId);
            if ($ret === false)
                LogHelper::error('delete part package failed, pkgId : ' . $note['pkgId'], Errno::FATAL);

            return;
        }
    }
}

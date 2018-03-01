<?php

class ModelLogicPutStatus
{
    protected $modelDataRead;

    public function __construct()
    {
        $this->modelDataRead = new ModelDataRead();
    }

    public function execute($userId, $scriptId, $readPos, $fontSize, $backColor)
    {
        $readStatus = $this->modelDataRead->getReadStatus($userId, $scriptId);
        $updateTime = time();
        if (empty($readStatus)) {
            $ret = $this->modelDataRead->addReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime);
            if ($ret === false)
                throw new Exception('add read status failed', Errno::FATAL);
        } else {
            $ret = $this->modelDataRead->modifyReadStatus($userId, $scriptId, $readPos, $fontSize, $backColor, $updateTime);
            if ($ret === false)
                throw new Exception('edit read status failed', Errno::FATAL);
        }
    }

}

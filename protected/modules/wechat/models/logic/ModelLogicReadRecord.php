<?php

class ModelLogicReadRecord
{
    protected $modelDataReadRecord;

    public function __construct()
    {
        $this->modelDataReadRecord = new ModelDataReadRecord();
    }

    public function execute($userId, $scriptId)
    {
        $updateTime = $lastReadTime = time();
        $user = $this->modelDataReadRecord->queryUser($userId);

        $lastDay = strtotime(date('Y-m-d', $user['lastReadTime']));
        $thisDay = strtotime(date('Y-m-d', $updateTime));
        $diffTime = $thisDay - $lastDay;

        $readDays = $user['readDays'];
        $keepReadDays = $user['keepReadDays'];
        $readNum = $user['readNum'];

        if ($diffTime > CommonConst::DAY_SEC) {
            $readDays++;
            $keepReadDays = $diffTime >= 2 * CommonConst::DAY_SEC ? 1 : $keepReadDays + 1;
        }

        $record = $this->modelDataReadRecord->findReadRecord($userId, $scriptId);

        if (empty($record)) {
            $ret = $this->modelDataReadRecord->addReadRecord($userId, $scriptId, $updateTime);
            if ($ret === false)
                throw new Exception('add read record failed', Errno::FATAL);
            
            $readNum++;
        } else {
            $ret = $this->modelDataReadRecord->updateReadRecord($userId, $scriptId, $updateTime, 1);
            if ($ret === false)
                throw new Exception('add read record failed', Errno::FATAL);
        }

        $ret = $this->modelDataReadRecord->updateRecord($userId, $readNum, $readDays, $keepReadDays, $lastReadTime, $updateTime);
        if ($ret === false)
            throw new Exception('update user record failed', Errno::FATAL);
    }
}

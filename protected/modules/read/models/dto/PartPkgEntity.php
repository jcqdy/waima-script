<?php
class PartPkgEntity
{
    public $pkgId;

    public $userId;

    public $name;

    public $partNum;

    public $createTime;

    public $updateTime;

    public $status;

    public function __construct($pkg)
    {
        $this->pkgId = isset($pkg['_id']) ? (string)$pkg['_id'] : '';
        $this->userId = isset($pkg['userId']) ? (string)$pkg['userId'] : '';
        $this->name = isset($pkg['name']) ? (string)$pkg['name'] : '';
        $this->partNum = isset($pkg['partNum']) ? (int)$pkg['partNum'] : 0;
        $this->createTime = isset($pkg['createTime']) ? (int)$pkg['createTime'] : time();
        $this->updateTime = isset($pkg['updateTime']) ? (int)$pkg['updateTime'] : time();
        $this->status = isset($pkg['status']) ? (int)$pkg['status'] : 1;
    }
}

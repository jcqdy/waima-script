<?php

class CollectEntity
{
    public $partId;

    public $userId;

    public $scriptId;

    public $pkgId;

    public $markPos;

    public $mark;

    public $createTime;

    public $status;

    public function __construct($collect)
    {
        $this->partId = isset($collect['_id']) ? (string)$collect['_id'] : '';
        $this->userId = isset($collect['userId']) ? (string)$collect['userId'] : '';
        $this->scriptId = isset($collect['scriptId']) ? (string)$collect['scriptId'] : '';
        $this->pkgId = isset($collect['pkgId']) ? (string)$collect['pkgId'] : '';
        $this->markPos = isset($collect['markPos']) ? $collect['markPos'] : [];
        $this->mark = isset($collect['mark']) ? $collect['mark'] : '';
        $this->createTime = isset($collect['createTime']) ? (int)$collect['createTime'] : time();
        $this->status = isset($collect['status']) ? $collect['status'] : 1;
    }
}

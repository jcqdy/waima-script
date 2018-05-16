<?php

class ModelLogicConfBanner
{
    public $modelDataConf;

    public function __construct()
    {
        $this->modelDataConf = new ModelDataConf();
    }

    public function execute($type, $data, $gotoType, $sort)
    {
        $tmpDir = RUNTIME_DIR . '/tmp/';
        ! is_dir($tmpDir) && @mkdir($tmpDir, 0755, true);

        move_uploaded_file($_FILES['pic']['tmp_name'], $tmpDir . $_FILES['pic']['name']);

        $etag = QiniuHelper::uploadFile($tmpDir . $_FILES['pic']['name']);

        unlink($tmpDir . $_FILES['pic']['name']);

        $createTime = time();
        $op = $this->modelDataConf->addOp($type, $gotoType, $etag, $sort, $createTime, 1);
        if ($op == false)
            throw new Exception('add operation failed', Errno::INTERNAL_SERVER_ERROR);

        $ret = $this->modelDataConf->addActive($type, $data, $op['_id'], $createTime, 1);
        if ($op == false)
            throw new Exception('add active failed', Errno::INTERNAL_SERVER_ERROR);

    }
}

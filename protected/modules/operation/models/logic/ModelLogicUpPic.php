<?php

class ModelLogicUpPic
{
    public function execute()
    {
        $tmpDir = RUNTIME_DIR . '/tmp/';
        ! is_dir($tmpDir) && @mkdir($tmpDir, 0755, true);

        move_uploaded_file($_FILES['pic']['tmp_name'], $tmpDir . $_FILES['pic']['name']);

        $etag = QiniuHelper::uploadFile($tmpDir . $_FILES['pic']['name']);
        unlink($tmpDir . $_FILES['pic']['name']);
        if ($etag == false)
            throw new Exception('upload pic failed', Errno::INTERNAL_SERVER_ERROR);

        return ['etag' => $etag];
    }
}

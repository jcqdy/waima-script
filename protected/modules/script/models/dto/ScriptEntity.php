<?php
class ScriptEntity
{
    public $scriptId;

    public $scriptName;

    public $fileUrl;

    public $coverUrl;

    public $scriptType;

    public $scriptTypeId;

    public $writer;

    public $readerNum;

    public $createTime;

    public function __construct($data)
    {
        $this->scriptId = isset($data['_id']) ? (string)$data['_id'] : '';
        $this->scriptName = isset($data['name']) ? $data['name'] : '';
        $this->fileUrl = isset($data['fileUrl']) ? $data['fileUrl'] : '';
        $this->coverUrl = isset($data['coverUrl']) ? $data['coverUrl'] : '';
        $this->scriptTypeId = isset($data['typeIds']) ? $data['typeIds'] : [];
        $this->scriptType = isset($data['scriptType']) ? $data['scriptType'] : [];
        $this->writer = isset($data['writer']) ? $data['writer'] : [];
        $this->readerNum = isset($data['readerNum']) ? $data['readerNum'] : 500;
        $this->createTime = isset($data['createTime']) ? $data['createTime'] : 0;
    }

}

<?php
class ModelLogicDelNoteMark
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($noteId, $markId)
    {
        if (empty($noteId) && empty($markId))
            throw new Exception('noteId or markId error', Errno::PARAMETER_VALIDATION_FAILED);
        
        $delId = empty($noteId) ? $markId : $noteId;
        $ret = $this->modelDataNoteMark->deleteNoteMark($delId);
        if ($ret == false)
            throw new Exception('del noteMark failed', Errno::FATAL);
    }
}

<?php

class ModelLogicEditNote
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($userId, $noteId, $note)
    {
        $oldNote = $this->modelDataNoteMark->findNoteMark($noteId);
        if (empty($oldNote))
            throw new Exception('note is not exist', Errno::PARAMETER_VALIDATION_FAILED);

        if ($oldNote['userId'] !== $userId)
            throw new Exception('userId is wrong', Errno::PARAMETER_VALIDATION_FAILED);

        $updateTime = time();
        $ret = $this->modelDataNoteMark->editNote($noteId, $note, $updateTime);
        if ($ret !== true)
            throw new Exception('edit note failed', Errno::FATAL);
    }
}

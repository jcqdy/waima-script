<?php

class ModelDataNoteMark
{
    protected $modelDaoNoteMark;

    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoNoteMark = new ModelDaoNoteMark();
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function getNoteMark($userId, $scriptIds, $status = 1)
    {
        return $this->modelDaoNoteMark->queryByUidSid($userId, $scriptIds, $status);
    }

    public function getScript($scriptId)
    {
        return $this->modelDaoScript->findOneScript($scriptId);
    }

    public function deleteNoteMark($delId)
    {
        return $this->modelDaoNoteMark->delByid($delId);
    }

    public function findNoteMark($noteId)
    {
        return $this->modelDaoNoteMark->getNoteMark($noteId);
    }

    public function editNote($noteId, $note, $updateTime)
    {
        return $this->modelDaoNoteMark->editNote($noteId, $note, $updateTime);
    }

    public function addNote($scriptId, $userId, $markPos, $mark, $note, $createTime)
    {
        return $this->modelDaoNoteMark->addNote($scriptId, $userId, $markPos, $mark, $note, $createTime);
    }

    public function addMark($scriptId, $userId, $markPos, $mark, $createTime)
    {
        return $this->modelDaoNoteMark->addMark($scriptId, $userId, $markPos, $mark, $createTime);
    }
}

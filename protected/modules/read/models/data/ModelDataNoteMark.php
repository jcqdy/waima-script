<?php

class ModelDataNoteMark
{
    protected $modelDaoNoteMark;

    protected $modelDaoScript;

    protected $modelDaoPartPkg;

    public function __construct()
    {
        $this->modelDaoNoteMark = new ModelDaoNoteMark();
        $this->modelDaoScript = new ModelDaoScript();
        $this->modelDaoPartPkg = new ModelDaoPartPkg();
    }

    public function getNoteMark($userId, $scriptId, $sp, $num, $status = 1)
    {
        return $this->modelDaoNoteMark->queryByUidSidSortUpTime($userId, $scriptId, $sp, $num, $status);
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

    public function addNote($scriptId, $userId, $mark, $markId, $note, $createTime)
    {
        return $this->modelDaoNoteMark->addNote($scriptId, $userId, $mark, $markId, $note, $createTime);
    }

    public function addMark($scriptId, $userId, $markPos, $mark, $createTime)
    {
        return $this->modelDaoNoteMark->addMark($scriptId, $userId, $markPos, $mark, $createTime);
    }

    public function incPartNum($pkgId, $incNum, $updateTime, $status = 1)
    {
        return $this->modelDaoPartPkg->incPartNum($pkgId, $incNum, $updateTime, $status);
    }

    public function getPkgByPid($pkgId, $status = 1)
    {
        return $this->modelDaoPartPkg->findByPkgId($pkgId, $status);
    }

    public function delPkg($pkgId)
    {
        return $this->modelDaoPartPkg->delPkg($pkgId);
    }

    public function queryNoteScriptIds($userId, $status = 1)
    {
        return $this->modelDaoNoteMark->queryByUidDistSid($userId, $status);
    }

    public function queryBySids($scriptIds)
    {
        return $this->modelDaoScript->queryByIds($scriptIds);
    }
}

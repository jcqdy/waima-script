<?php

class ModelDataCollect
{
    protected $modelDaoScriptPart;

    protected $modelDaoPartPkg;

    protected $modelDaoScript;

    protected $modelDaoNoteMark;

    public function __construct()
    {
        $this->modelDaoScriptPart = new ModelDaoScriptPart();
        $this->modelDaoPartPkg = new ModelDaoPartPkg();
        $this->modelDaoScript = new ModelDaoScript();
        $this->modelDaoNoteMark = new ModelDaoNoteMark();
    }

    public function getScript($scriptId)
    {
        return $this->modelDaoScript->findOneScript($scriptId);
    }

    public function queryScripts($scriptIds)
    {
        return $this->modelDaoScript->queryByIds($scriptIds);
    }

    public function addPart($scriptId, $userId, $pkgId, $markPos, $mark, $createTime)
    {
        return $this->modelDaoScriptPart->addPart($scriptId, $userId, $pkgId, $markPos,
            $mark, $createTime);
    }

    public function addPkg($pkgId, $userId, $pkgName, $createTime)
    {
        return $this->modelDaoPartPkg->addPkg($pkgId, $userId, $pkgName, $createTime);
    }

    public function incPartNum($pkgId, $incNum, $updateTime, $status = 1)
    {
        return $this->modelDaoPartPkg->incPartNum($pkgId, $incNum, $updateTime, $status);
    }

    public function delPart($partId, $delTime)
    {
        return $this->modelDaoScriptPart->delPart($partId, $delTime);
    }

    public function getPartByPidUid($partId, $userId, $status = 1)
    {
        return $this->modelDaoScriptPart->getByPidUid($partId, $userId, $status);
    }

    public function getByPartId($partId, $status)
    {
        return $this->modelDaoScriptPart->getByPartId($partId, $status);
    }

    public function editPkg($pkgId, $name, $updateTime, $status = 1)
    {
        return $this->modelDaoPartPkg->editName($pkgId, $name, $updateTime, $status);
    }

    public function getPkgByPid($pkgId, $status = 1)
    {
        return $this->modelDaoPartPkg->findByPkgId($pkgId, $status);
    }

    public function queryPkgList($userId, $status = 1)
    {
        return $this->modelDaoPartPkg->queryByUserId($userId, $status);
    }

    public function delPkg($pkgId)
    {
        return $this->modelDaoPartPkg->delPkg($pkgId);
    }

    public function updateNotePkgId($noteId, $pkgId, $status = 1)
    {
        return $this->modelDaoNoteMark->updatePkgId($noteId, $pkgId, $status);
    }

    public function queryCollectList($pkgId, $status = 1)
    {
        return $this->modelDaoNoteMark->queryByPkgId($pkgId, $status);
    }
}

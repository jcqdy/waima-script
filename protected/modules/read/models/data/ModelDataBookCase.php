<?php
class ModelDataBookCase
{
    protected $modelDaoScript;

    protected $modelDaoBookCase;

    protected $modelDaoScriptType;

    public function __construct()
    {
        $this->modelDaoScript = new ModelDaoScript();
        $this->modelDaoBookCase = new ModelDaoBookCase();
        $this->modelDaoScriptType = new ModelDaoScriptType();
        $this->modelDaoReadStatus = new ModelDaoReadStatus();
    }

    /**
     * 获取该用户书架中的剧本id
     *
     * @param $userId
     * @return array|float|string
     */
    public function getBookCase($userId)
    {
        return $this->modelDaoBookCase->getById($userId);
    }

    public function queryScripts(array $scriptIds)
    {
        return $this->modelDaoScript->queryByIds($scriptIds);
    }

    public function queryTypes(array $typeIds)
    {
        return $this->modelDaoScriptType->queryByIds($typeIds);
    }

    public function modifyScriptIds($userId, $data)
    {
        return $this->modelDaoBookCase->modifyScriptIds($userId, $data);
    }

    public function deleteReadStatus($userId, $scriptId)
    {
        return $this->modelDaoReadStatus->deleteReadStatus($userId, $scriptId);
    }

    public function findScript($scriptId)
    {
        return $this->modelDaoScript->findOneScript($scriptId);
    }

}

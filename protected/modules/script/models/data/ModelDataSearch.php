<?php

class ModelDataSearch
{
    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function search($keywords)
    {
        return $this->modelDaoScript->search($keywords);
    }
}

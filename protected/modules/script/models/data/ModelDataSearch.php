<?php

class ModelDataSearch
{
    protected $modelDaoScript;

    public function __construct()
    {
        $this->modelDaoScript = new ModelDaoScript();
    }

    public function search($keywords, $sp, $num)
    {
        return $this->modelDaoScript->search($keywords, $sp, $num);
    }
}

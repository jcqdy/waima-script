<?php

class ModelLogicSearch
{
    protected $modelDataSearch;

    public function __construct()
    {
        $this->modelDataSearch = new ModelDataSearch();
    }

    public function execute($keyword)
    {
        if (count($keyword) > 4)
            $keyword = array_slice($keyword, 0, 4);

        $res = $this->modelDataSearch->search($keyword);
        if (empty($res))
            return [];

        $ret = [];
        foreach ($res as $value) {
            $ret[] = new ScriptEntity($value);
        }

        return $ret;
    }
}
<?php

class ModelLogicSearch
{
    protected $modelDataSearch;

    public function __construct()
    {
        $this->modelDataSearch = new ModelDataSearch();
    }

    public function execute($keyword, $sp, $num)
    {
        if (count($keyword) > 4)
            $keyword = array_slice($keyword, 0, 4);

        $res = $this->modelDataSearch->search($keyword, $sp, $num);
        if (empty($res))
            return ['items' => [], 'sp' => -1];

        $ret = ['items' => [], 'sp' => $sp + count($res)];
        foreach ($res as $value) {
            $ret['items'][] = new ScriptEntity($value);
        }

        return $ret;
    }
}
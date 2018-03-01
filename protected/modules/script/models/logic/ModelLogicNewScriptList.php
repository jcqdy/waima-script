<?php

class ModelLogicNewScriptList
{
    protected $modelDataScriptList;

    public function __construct()
    {
        $this->modelDataScriptList = new ModelDataScriptList();
    }

    public function execute($sp, $num)
    {
        $scripts = $this->modelDataScriptList->getHotScripts($sp, $num);
        if (empty($scripts))
            return ['items' => [], 'sp' => $sp];
        
        $end = count($scripts) - 1;
        $newSp = $scripts[$end]['createTime'];

        $ret = ['items' => [], 'sp' => $newSp];
        foreach ($scripts as $script) {
            $ret['items'][] = new ScriptEntity($script);
        }

        return $ret;
    }
}

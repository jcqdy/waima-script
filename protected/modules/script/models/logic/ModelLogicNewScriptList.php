<?php

class ModelLogicNewScriptList
{
    protected $modelDataScriptList;

    protected $defaultRet = [
        'items' => [],
        'sp' => -1,
    ];

    public function __construct()
    {
        $this->modelDataScriptList = new ModelDataScriptList();
    }

    public function execute($sp, $num)
    {
        $scripts = $this->modelDataScriptList->getHotScripts($sp, $num);
        if (empty($scripts))
            return $this->defaultRet;
        
        $endId = end($scripts);
        $newSp = $scripts[$endId]['createTime'];

        $ret = ['items' => [], 'sp' => $newSp];
        foreach ($scripts as $script) {
            $ret['items'][] = new ScriptEntity($script);
        }

        return $ret;
    }
}

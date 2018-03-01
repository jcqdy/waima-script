<?php
class ModelLogicHotScriptList
{
    protected $modelDataScriptList;

    public function __construct()
    {
        $this->modelDataScriptList = new ModelDataScriptList();
    }

    public function execute($sp, $num)
    {
        $scripts = $this->modelDataScriptList->getHotScripts($sp, $num);

        $ret = ['items' => [], 'sp' => $sp + $num];
        foreach ($scripts as $script) {
            $ret['items'][] = new ScriptEntity($script);
        }

        return $ret;
    }
}
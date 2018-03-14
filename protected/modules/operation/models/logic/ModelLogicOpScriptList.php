<?php

class ModelLogicOpScriptList
{
    protected $modelDataOpScriptList;

    public function __construct()
    {
        $this->modelDataOpScriptList = new ModelDataOpScriptList();
    }

    public function execute($opId, $sp, $num)
    {
        $active = $this->modelDataOpScriptList->getActive($opId);
        if (empty($active))
            throw new Exception('该专题已经下线', Errno::ACTIVE_OFF_LINE);

        if ($active['type'] !== CommonConst::ACTIVE_SCRIPT_LIST)
            throw new Exception('该专题已经下线', Errno::ACTIVE_OFF_LINE);

        $scriptIds = $active['data']['script'];
        $scriptIds = array_slice($scriptIds, $sp, $num);
        if (empty($scriptIds))
            return ['items' => [], 'sp' => -1];

        $scripts = $this->modelDataOpScriptList->queryScriptByIds($scriptIds);
        if (empty($scripts))
            throw new Exception('该专题已经下线', Errno::ACTIVE_OFF_LINE);

        $ret = ['items' => [], 'sp' => $sp + count($scripts)];

        $ret['items'] = new OpScriptListEntity($active['data']['title'], $opId, $scripts);

        return $ret;
    }
}

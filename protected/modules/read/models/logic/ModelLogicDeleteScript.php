<?php

class ModelLogicDeleteScript
{
    protected $modelDataBookCase;


    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $scriptIds)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $bookCase['scriptIds'];
        foreach ($bookCase as $key => $val) {
            if (is_string($val) && in_array($val, $scriptIds)) {
                unset($bookCase[$key]);
            }

            if (is_array($val)) {
                $inIds = array_intersect($val['scriptIds'], $scriptIds);
                if (! empty($inIds)) {
                    $inIdskey = array_keys($inIds);
                    foreach ($inIdskey as $k) {
                        unset($bookCase[$key]['scriptIds'][$k]);
                    }
                }
            }
        }
        
        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('delete script failed', Errno::FATAL);

//        $ret = $this->modelDataBookCase->deleteReadStatus($userId, $scriptId);
//        if ($ret == false)
//            throw new Exception('delete script failed', Errno::FATAL);
    }
}

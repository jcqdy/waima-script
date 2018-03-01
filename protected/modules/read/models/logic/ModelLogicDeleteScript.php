<?php

class ModelLogicDeleteScript
{
    protected $modelDataBookCase;


    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $scriptId)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $bookCase['scriptIds'];
        foreach ($bookCase as $key => $val) {
            if (is_string($val) && $val === $scriptId) {
                unset($bookCase[$key]);
                break;
            }

            if (is_array($val) && in_array($scriptId, $val['scriptIds'])) {
                $k = array_search($scriptId, $val['scriptIds']);
                unset($bookCase[$key]['scriptIds'][$k]);
                break;
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

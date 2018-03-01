<?php
class ModelLogicAddScript
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

        foreach ($bookCase as $val) {
            if (is_string($val) && $val == $scriptId)
                return [];

            if (is_array($val) && in_array($scriptId, $val['scriptIds']))
                return [];
        }

        array_unshift($bookCase, $scriptId);

        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('add script failed', Errno::FATAL);
    }
}

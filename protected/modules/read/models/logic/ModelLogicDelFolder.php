<?php

class ModelLogicDelFolder
{
    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $folderId)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $oldBookCase = $bookCase['scriptIds'];

        foreach ($oldBookCase as $key => $val) {
            if (is_array($val) && $val['folderId'] == $folderId) {
                $scriptIds = $oldBookCase['scriptIds'];
                unset($bookCase[$key]);
                foreach ($scriptIds as $id) {
                    $bookCase[] = $id;
                }
                break;
            }
        }

        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('move script failed', Errno::FATAL);
    }
}

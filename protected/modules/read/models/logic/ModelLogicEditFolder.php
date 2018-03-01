<?php
class ModelLogicEditFolder
{
    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $name, $folderId)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $bookCase['scriptIds'];
        foreach ($bookCase as $key => $val) {
            if (! is_array($val))
                continue;

            if ($val['folderId'] == $folderId) {
                $bookCase[$key]['folderName'] = $name;
            }
        }

        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('edit folder failed', Errno::FATAL);
        
    }
}

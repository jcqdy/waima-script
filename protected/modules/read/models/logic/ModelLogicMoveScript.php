<?php
class ModelLogicMoveScript
{
    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $scriptId, $newFolderId, $folderName, $makeFolder)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $bookCase['scriptIds'];

        // 如果要创建新的文件夹
        if ($makeFolder == 1) {
            if (empty($folderName))
                throw new Exception('folderName is empty', Errno::INVALID_PARAMETER);

            $newFolder = [
                'folderName' => $folderName,
                'folderId' => (string) new MongoId(),
                'scriptIds' => [$scriptId],
            ];

            foreach ($bookCase as $key => $val) {
                if (is_string($val) && $val == $scriptId) {
                    $bookCase[$key] = $newFolder;
                    break;
                }

                if (is_array($val) && in_array($scriptId, $val['scriptIds'])) {
                    $k = array_search($scriptId, $val['scriptIds']);
                    unset($bookCase[$key]['scriptIds'][$k]);
                    $bookCase[] = $newFolder;
                    break;
                }
            }
        } else {
            foreach ($bookCase as $key => $val) {
                if (is_string($val) && $val == $scriptId) {
                    unset($bookCase[$key]);
                    continue;
                }
                if (is_array($val) && $val['folderId'] !== $newFolderId && in_array($scriptId, $val['scriptIds'])) {
                    $k = array_search($scriptId, $val['scriptIds']);
                    unset($bookCase[$key]['scriptIds'][$k]);
                    continue;
                }
                if (is_array($val) && $val['folderId'] == $newFolderId && ! in_array($scriptId, $val['scriptIds'])) {
                    $bookCase[$key]['scriptIds'][] = $scriptId;
                    continue;
                }
            }
        }

        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('move script failed', Errno::FATAL);
    }
}

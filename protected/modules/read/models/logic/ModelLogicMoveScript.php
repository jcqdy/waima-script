<?php
class ModelLogicMoveScript
{
    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $scriptIds, $newFolderId, $folderName, $makeFolder)
    {
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $bookCase = $oldBookCase = $bookCase['scriptIds'];

        // 如果要创建新的文件夹
        if ($makeFolder == 1) {
            if (empty($folderName))
                throw new Exception('folderName is empty', Errno::INVALID_PARAMETER);

            $newFolder = [
                'folderName' => $folderName,
                'folderId' => (string) new MongoId(),
                'scriptIds' => $scriptIds,
            ];

            foreach ($oldBookCase as $key => $val) {
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
            array_unshift($bookCase, $newFolder);
        } else {
            foreach ($oldBookCase as $key => $val) {
                // 如果是文件夹外的剧本,且没有指定移动到某个文件夹,跳过
                if (is_string($val) && in_array($val, $scriptIds) && empty($newFolderId))
                    break;

                // 是文件夹外的剧本,且指定移动到某个文件夹
                if (is_string($val) && in_array($val, $scriptIds)) {
                    unset($bookCase[$key]);
                    continue;
                }

                // 文件夹中的剧本,要进行移动
                if (is_array($val) && $val['folderId'] != $newFolderId) {
                    $inIds = array_intersect($val['scriptIds'], $scriptIds);
                    if (empty($inIds))
                        continue;

                    $inIdskey = array_keys($inIds);
                    foreach ($inIdskey as $k) {
                        unset($bookCase[$key]['scriptIds'][$k]);
                    }

                    // 如果没有指定移动到其他文件夹,就移动到文件夹外面
                    if (empty($newFolderId)) {
                        foreach ($scriptIds as $id) {
                            $bookCase[] = $id;
                        }
                        break;
                    }
                }

                // 把剧本移动到目标文件夹中
                if (is_array($val) && $val['folderId'] == $newFolderId) {
                    $diffIds = array_diff($scriptIds, $val['scriptIds']);
                    if (! empty($diffIds)) {
                        foreach ($diffIds as $id) {
                            $bookCase[$key]['scriptIds'][] = $id;
                        }
                    }
                }
            }
        }

        $ret = $this->modelDataBookCase->modifyScriptIds($userId, $bookCase);
        if ($ret == false)
            throw new Exception('move script failed', Errno::FATAL);
    }
}

<?php

class ModelLogicBookCase
{
    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId)
    {
        // 获取该用户的书架数据
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        if (empty($bookCase))
            return [];

        $scriptIds = [];
        $bookCase = $bookCase['scriptIds'];
        // 将书架中剧本的id整合
        foreach ($bookCase as $key => $val) {
            if (is_string($val)) {
                $scriptIds[] = $val;
            }
            if (is_array($val)) {
                $scriptIds = array_merge($scriptIds, $val['scriptIds']);
            }
        }

        // 查询出剧本的信息
        $scripts = $this->modelDataBookCase->queryScripts($scriptIds);
        if (empty($scripts))
            return [];

        // 合并剧本的类型id
        $typeIds = [];
        foreach ($scripts as $scriptId => $script) {
            $typeIds[] = array_merge($typeIds, $script['typeIds']);
        }
        
        // 按照书架表查出的数据结构,重新遍历整合剧本信息
        $ret = [];
        foreach ($bookCase as $key => $val) {
            // 单个剧本的情况
            if (is_string($val)) {
                if (! in_array($val, $scriptIds))
                    continue;

                $ret[] = new BookCaseScriptEntity(0, [$scripts[$val]]);
            }

            // 文件夹的情况
            if (is_array($val)) {
                $scriptList = [];
                foreach ($val['scriptIds'] as $id) {
                    $scriptList[] = $scripts[$id];
                }
                $ret[] = new BookCaseScriptEntity(1, $scriptList, $val['folderName'], $val['folderId']);
            }
        }

        return $ret;
    }
}

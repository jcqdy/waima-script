<?php
class ModelLogicBatchFetch
{
    protected $modelDataRead;

    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataRead = new ModelDataRead();
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($userId, $scriptIds)
    {
        $status = $this->modelDataRead->queryReadStatus($userId, $scriptIds);

        // 如果查询不到剧本的阅读状态,则返回默认值
        if (empty($status))
            return [];

        $noteMarks = $this->modelDataRead->getNoteMark($userId, $scriptIds);
        $bookCase = $this->modelDataBookCase->getBookCase($userId);

        $ret = [];
        foreach ($status as $key => $val) {
            $noteMarkList = [];
            foreach ($noteMarks as $v) {
                if ($v['scriptId'] !== $val['scriptId'])
                    continue;

                $noteMarkList[] = $v;
                break;
            }

            $inBookCase = 0;
            foreach ($bookCase as $k => $value) {
                if (is_string($value) && $value === $val['scriptId']) {
                    $inBookCase = 1;
                    break;
                }
                if (is_array($value) && in_array($val['scriptId'], $value['scriptIds'])) {
                    $inBookCase = 1;
                    break;
                }
            }

            $ret[] = new ReadStatusEntity($status, $noteMarkList, $inBookCase);
        }

        return $ret;
    }
}

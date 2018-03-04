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
        $noteMarks = $this->modelDataRead->getNoteMark($userId, $scriptIds);
        $bookCase = $this->modelDataBookCase->getBookCase($userId);
        $readStatus = $this->modelDataRead->getUserReadStatus($userId);

        $scriptItems = [];

        foreach ($scriptIds as $id) {
            $noteList = $statList = [];
            $inBookCase = 0;
            foreach ($noteMarks as $note) {
                if ($note['scriptId'] === $id) {
                    $noteList[] = $note;
                    break;
                }
            }
            foreach ($status as $stat) {
                if ($stat['scriptId'] === $id) {
                    $statList = $stat;
                    break;
                }
            }
            foreach ($bookCase['scriptIds'] as $value) {
                if (is_string($value) && $value === $id) {
                    $inBookCase = 1;
                    break;
                }
                if (is_array($value) && in_array($id, $value['scriptIds'])) {
                    $inBookCase = 1;
                    break;
                }
            }

            $scriptItems[] = new ScriptStatusEntity($id, $noteList, $inBookCase, $statList);
        }
        
        return new ReadStatusEntity($readStatus, $scriptItems);
    }
}

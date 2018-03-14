<?php

class ModelLogicFetch
{
    protected $modelDataRead;

    protected $modelDataBookCase;

    public function __construct()
    {
        $this->modelDataRead = new ModelDataRead();
        $this->modelDataBookCase = new ModelDataBookCase();
    }

    public function execute($scriptId, $userId)
    {
        $script = $this->modelDataBookCase->findScript($scriptId);
        if (empty($script))
            throw new Exception('script is not exist', Errno::INVALID_PARAMETER);

        $inBookCase = 0;
        $bookCase = $this->modelDataBookCase->getBookCase($userId);

        if (! empty($bookCase)) {
            foreach ($bookCase['scriptIds'] as $value) {
                if (is_string($value) && $value === $scriptId) {
                    $inBookCase = 1;
                    break;
                }
                if (is_array($value) && in_array($scriptId, $value['scriptIds'])) {
                    $inBookCase = 1;
                    break;
                }
            }
        }

        $readStatus = $this->modelDataRead->getUserReadStatus($userId);
        $status = $this->modelDataRead->getReadStatus($userId, $scriptId);

        return new ScriptFetchEntity($readStatus, $script, $inBookCase, $status);
    }
}

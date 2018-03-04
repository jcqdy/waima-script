<?php

class ModelLogicAddNote
{
    protected $modelDataNoteMark;

    public function __construct()
    {
        $this->modelDataNoteMark = new ModelDataNoteMark();
    }

    public function execute($userId, $note, $scriptId, $mark, $markPos)
    {
        $script = $this->modelDataNoteMark->getScript($scriptId);
        if (empty($script))
            throw new Exception('script is not exist', Errno::PARAMETER_VALIDATION_FAILED);

//        $scriptDir = WWW_DIR . '/../scriptFiles';
//        $scriptPath = $scriptDir . '/' . $script['name'] . $script['_id'];

//        // 如果本地没有剧本则从网上下载
//        if (! file_exists($scriptPath)) {
//            $content = file_get_contents($script['fileUrl']);
//            if (! is_dir($scriptDir))
//                mkdir($scriptDir);
//
//            // 并将剧本写入到本地文件
//            @file_put_contents($scriptPath, $content);
//        } else {
//            $content = file_get_contents($scriptPath);
//        }
//        $pos = mb_strpos($content, $mark);
//        $markPos = [
//            $pos + 1,
//            $pos + mb_strlen($mark)
//        ];

        $createTime = time();

        $ret = $this->modelDataNoteMark->addNote($scriptId, $userId, $markPos, $mark, $note, $createTime);
        if ($ret === false)
            throw new Exception('add note failed', Errno::FATAL);

        return new NoteMarkEntity($ret);
    }
}

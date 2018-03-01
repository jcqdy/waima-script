<?php
class ReadStatusEntity
{
    public $scriptId;

    public $readPos;

    public $fontSize;

    public $backColor;

    public $inBookCase;

    public $noteMark = [];

    public function __construct($status, $noteMarkList, $inBookCase)
    {
        $this->scriptId = isset($status['scriptId']) ? (string)$status['scriptId'] : '';
        $this->readPos = isset($status['readPos']) ? $status['readPos'] : CommonConst::DEFAULT_READ_POS;
        $this->fontSize = isset($status['fontSize']) ? (int)$status['fontSize'] : CommonConst::DEFAULT_FONT_SIZE;
        $this->backColor = isset($status['backColor']) ? (int)$status['backColor'] : CommonConst::DEFAULT_BACK_COLOR;
        $this->inBookCase = $inBookCase;

        foreach ($noteMarkList as $val) {
            $this->noteMark[] = [
                'id' => isset($val['_id']) ? (string)$val['_id'] : '',
                'markPos' => isset($val['markPos']) ? $val['markPos'] : [],
                'type' => isset($val['type']) ? $val['type'] : 1,
            ];
        }
    }
}

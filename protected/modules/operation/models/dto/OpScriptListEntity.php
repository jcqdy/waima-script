<?php

class OpScriptListEntity
{
    public $title;

    public $opId;

    public $script = [];

    public function __construct($title, $opId, $scriptList)
    {
        $this->title = $title;
        $this->opId = (string)$opId;

        foreach ($scriptList as $script) {
            $this->script[] = new ScriptEntity($script);
        }
    }
}

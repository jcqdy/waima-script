<?php

class TypeScriptListEntity
{
    public $scriptType = [];

    public $scriptList = [];

    public function __construct($type, $scripts)
    {
        $this->scriptType[] = [
            'typeId' => isset($type['_id']) ? (string)$type['_id'] : '',
            'typeName' => isset($type['name']) ? $type['name'] : '',
        ];

        foreach ($scripts as $script) {
            $this->scriptList[] = new ScriptEntity($script);
        }
    }
}

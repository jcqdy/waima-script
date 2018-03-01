<?php

class TypeScriptListEntity
{
    public $scriptType = [];

    public $currType;

    public $scriptList = [];

    public function __construct($types, $currType, $scripts, $isTypeList)
    {
        if ($isTypeList === 1) {
            foreach ($types as $type) {
                $this->scriptType[] = [
                    'typeId' => isset($type['_id']) ? $type['_id'] : '',
                    'typeName' => isset($type['name']) ? $type['name'] : '',
                ];
            }
        }

        $this->currType = $currType;

        foreach ($scripts as $script) {
            $this->scriptList[] = new ScriptEntity($script);
        }
    }
}

<?php
class ModelLogicTypeScriptList
{
    protected $modelDataType;

    public function __construct()
    {
        $this->modelDataType = new ModelDataType();
    }

    public function execute($typeId, $isTypeList, $sp, $num)
    {
        if ($isTypeList === 1) {
            $types = $this->modelDataType->queryTypes();
            if (empty($types))
                throw new Exception('get type list failed', Errno::FATAL);
        } else {
            $types = $this->modelDataType->getType($typeId);
        }

        $scripts = $this->modelDataType->queryScriptByTypeId($typeId, $sp, $num);

        $currType = isset($types[$typeId]) ? $types[$typeId] : [];
        
        return new TypeScriptListEntity($types, $currType, $scripts, $isTypeList);
    }
}

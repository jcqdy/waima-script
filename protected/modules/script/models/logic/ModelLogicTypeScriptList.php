<?php
class ModelLogicTypeScriptList
{
    protected $modelDataType;

    public function __construct()
    {
        $this->modelDataType = new ModelDataType();
    }

    public function execute($typeId, $sp, $num)
    {
        $ret = ['items' => [], 'sp' => -1];

        $type = $this->modelDataType->getType($typeId);
        if (empty($type))
            throw new Exception('type is not exist', Errno::INVALID_PARAMETER);

        $scripts = $this->modelDataType->queryScriptByTypeId($typeId, $sp, $num);
        if (empty($scripts)) {
            $ret['items'] = new TypeScriptListEntity($type, $scripts);
            return $ret;
        }

        $ret['items'] = new TypeScriptListEntity($type, $scripts);
        $ret['sp'] = $sp + count($scripts);

        return $ret;
    }
}

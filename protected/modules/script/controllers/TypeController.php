<?php
class TypeController extends Controller
{
    public function actionScriptList()
    {
        $typeId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'typeId');
//        $isTypeList = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'isTypeList', [0,1]);
        $sp = ParameterValidatorHelper::validateInteger($_REQUEST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num', 1, 20, 20);

        $modelLogicTypeScriptList = new ModelLogicTypeScriptList();
        $ret = $modelLogicTypeScriptList->execute($typeId, $sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

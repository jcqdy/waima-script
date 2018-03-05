<?php
class TypeController extends Controller
{
    public function actionScriptList()
    {
        $typeId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'typeId');
//        $isTypeList = ParameterValidatorHelper::validateEnumInteger($_POST, 'isTypeList', [0,1]);
        $sp = ParameterValidatorHelper::validateInteger($_POST, 'sp', 0);
        $num = ParameterValidatorHelper::validateInteger($_POST, 'num', 1, 20, 20);

        $modelLogicTypeScriptList = new ModelLogicTypeScriptList();
        $ret = $modelLogicTypeScriptList->execute($typeId, $sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

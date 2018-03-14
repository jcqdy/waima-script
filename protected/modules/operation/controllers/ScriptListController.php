<?php

class ScriptListController extends Controller
{
    public function actionIndex()
    {
        $opId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'opId');
        $sp = ParameterValidatorHelper::validateInteger($_POST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_POST, 'num', 1, 100, 30);

        $modelLogicOpScriptList = new ModelLogicOpScriptList();
        $ret = $modelLogicOpScriptList->execute($opId, $sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

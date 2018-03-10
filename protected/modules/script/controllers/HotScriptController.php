<?php
class HotScriptController extends Controller
{
    public function actionList()
    {
        $sp = ParameterValidatorHelper::validateInteger($_POST, 'sp', null, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_POST, 'num', 1, 20, 20);

        $modelLogicHotScriptList = new ModelLogicHotScriptList();
        $ret = $modelLogicHotScriptList->execute($sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

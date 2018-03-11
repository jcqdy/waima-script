<?php
class NewScriptController extends Controller
{
    public function actionList()
    {
        $sp = ParameterValidatorHelper::validateInteger($_POST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_POST, 'num', 1, 20, 20);

        $modelLogicNewScriptList = new ModelLogicNewScriptList();
        $ret = $modelLogicNewScriptList->execute($sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

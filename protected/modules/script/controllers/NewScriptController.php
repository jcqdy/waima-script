<?php
class NewScriptController extends Controller
{
    public function actionList()
    {
        $sp = ParameterValidatorHelper::validateInteger($_REQUEST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num', 1, 20, 20);

        $modelLogicNewScriptList = new ModelLogicNewScriptList();
        $ret = $modelLogicNewScriptList->execute($sp, $num);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

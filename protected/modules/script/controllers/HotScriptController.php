<?php
class HotScriptController extends Controller
{
    public function actionList()
    {
        $sp = ParameterValidatorHelper::validateInteger($_REQUEST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num', 1, 20, 20);

        $modelLogicHotScriptList = new ModelLogicHotScriptList();
        $ret = $modelLogicHotScriptList->execute($sp, $num);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

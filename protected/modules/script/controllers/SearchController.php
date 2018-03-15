<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $keyword = ParameterValidatorHelper::validateArray($_POST, 'keyword', ' ');
        $sp = ParameterValidatorHelper::validateInteger($_POST, 'sp', 0, PHP_INT_MAX, 0);
        $num = ParameterValidatorHelper::validateInteger($_POST, 'num', 1, 100, 30);
        
        $modelLogicSearch = new ModelLogicSearch();
        $ret = $modelLogicSearch->execute($keyword, $sp, $num);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

}

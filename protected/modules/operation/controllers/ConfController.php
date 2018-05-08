<?php

class ConfController extends Controller
{
    public function actionBanner()
    {
        $type = ParameterValidatorHelper::validateInteger($_POST, 'type', 0, PHP_INT_MAX);
        $data = $_POST['data'];
        $sort = ParameterValidatorHelper::validateInteger($_POST, 'sort', 0, PHP_INT_MAX);
        $gotoType = ParameterValidatorHelper::validateInteger($_POST, 'gotoType', 0, PHP_INT_MAX);

        $modelLogicConfBanner = new ModelLogicConfBanner();
        $modelLogicConfBanner->execute($type, $data, $gotoType, $resourceUrl, $sort);
        
    }
}

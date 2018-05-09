<?php

class ConfController extends H5Controller
{
    public function actionBanner()
    {
        $type = ParameterValidatorHelper::validateInteger($_POST, 'type', 0, PHP_INT_MAX);
        $data = Yii::app()->request->getParam('data', '');
        $sort = ParameterValidatorHelper::validateInteger($_POST, 'sort', 0, PHP_INT_MAX);
        $gotoType = ParameterValidatorHelper::validateInteger($_POST, 'gotoType', 0, PHP_INT_MAX);

        $modelLogicConfBanner = new ModelLogicConfBanner();
        $modelLogicConfBanner->execute($type, $data, $gotoType, $sort);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionUpPic()
    {
        $modelLogicUpPic = new ModelLogicUpPic();
        $ret = $modelLogicUpPic->execute();

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

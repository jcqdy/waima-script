<?php

class ShareController extends Controller
{
    public function actionInfo()
    {
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicShareInfo = new ModelLogicShareInfo();
        $ret = $modelLogicShareInfo->execute($scriptId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

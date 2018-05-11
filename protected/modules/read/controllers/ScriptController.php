<?php
class ScriptController extends Controller
{
    public function actionBatchFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptIds = ParameterValidatorHelper::validateArray($_REQUEST, 'scriptIds', ',');
        
        $modelLogicBatchFetch = new ModelLogicBatchFetch();
        $ret = $modelLogicBatchFetch->execute($userId, $scriptIds);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionPutStatus()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');
        $readPos = ParameterValidatorHelper::validateString($_REQUEST, 'readPos');
        $fontSize = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'fontSize', [12,14,16,18,20]);
        $backColor = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'backColor', [1,2,3,4]);

        $modelLogicPutStatus = new ModelLogicPutStatus();
        $modelLogicPutStatus->execute($userId, $scriptId, $readPos, $fontSize, $backColor);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicFetch = new ModelLogicFetch();
        $ret = $modelLogicFetch->execute($scriptId, $userId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

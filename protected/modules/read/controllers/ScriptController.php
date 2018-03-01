<?php
class ScriptController extends Controller
{
    public function actionBatchFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptIds = ParameterValidatorHelper::validateArray($_POST, 'scriptIds', ',');
        
        $modelLogicBatchFetch = new ModelLogicBatchFetch();
        $ret = $modelLogicBatchFetch->execute($userId, $scriptIds);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionPutStatus()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');
        $readPos = ParameterValidatorHelper::validateFloat($_POST, 'readPos');
        $fontSize = ParameterValidatorHelper::validateEnumInteger($_POST, 'readPos', [13,15,17,19,21]);
        $backColor = ParameterValidatorHelper::validateEnumInteger($_POST, 'readPos', [1,2,3,4]);

        $modelLogicPutStatus = new ModelLogicPutStatus();
        $modelLogicPutStatus->execute($userId, $scriptId, $readPos, $fontSize, $backColor);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }
}

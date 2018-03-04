<?php

class BookCaseController extends Controller 
{

    public function actionList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');

        $modelLogicBookCase = new ModelLogicBookCase();
        $ret = $modelLogicBookCase->execute($userId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionDelete()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');

        $modelLogicDeleteScript = new ModelLogicDeleteScript();
        $modelLogicDeleteScript->execute($userId, $scriptId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionMove()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');
        $newFolderId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'newFolderId', '');
        $name = ParameterValidatorHelper::validateString($_POST, 'name', 1, 50, '');
        $makeFolder = ParameterValidatorHelper::validateEnumInteger($_POST, 'makeFolder', [0,1]);

        $modelLogicMoveScript = new ModelLogicMoveScript();
        $modelLogicMoveScript->execute($userId, $scriptId, $newFolderId, $name, $makeFolder);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionEdit()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $name = ParameterValidatorHelper::validateString($_POST, 'name', 1, 50, '');
        $folderId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'folderId', '');

        $modelLogicEditFolder = new ModelLogicEditFolder();
        $modelLogicEditFolder->execute($userId, $name, $folderId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionAdd()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');

        $modelLogicAddScript = new ModelLogicAddScript();
        $modelLogicAddScript->execute($userId, $scriptId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }
}
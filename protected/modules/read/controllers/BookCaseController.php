<?php

class BookCaseController extends Controller 
{

    public function actionList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicBookCase = new ModelLogicBookCase();
        $ret = $modelLogicBookCase->execute($userId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionDelete()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptIds = ParameterValidatorHelper::validateArray($_REQUEST, 'scriptIds', ',');

        $modelLogicDeleteScript = new ModelLogicDeleteScript();
        $modelLogicDeleteScript->execute($userId, $scriptIds);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionMove()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptIds = ParameterValidatorHelper::validateArray($_REQUEST, 'scriptIds', ',');
        $newFolderId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'newFolderId', '');
        $name = ParameterValidatorHelper::validateString($_REQUEST, 'name', 1, 50, '');
        $makeFolder = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'makeFolder', [0,1]);

        $modelLogicMoveScript = new ModelLogicMoveScript();
        $modelLogicMoveScript->execute($userId, $scriptIds, $newFolderId, $name, $makeFolder);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionEdit()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $name = ParameterValidatorHelper::validateString($_REQUEST, 'name', 1, 50, '');
        $folderId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'folderId');

        $modelLogicEditFolder = new ModelLogicEditFolder();
        $modelLogicEditFolder->execute($userId, $name, $folderId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionAdd()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicAddScript = new ModelLogicAddScript();
        $modelLogicAddScript->execute($userId, $scriptId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionDelFolder()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $folderId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'folderId');

        $modelLogicDelFolder = new ModelLogicDelFolder();
        $modelLogicDelFolder->execute($userId, $folderId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }
}
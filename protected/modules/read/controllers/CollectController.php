<?php

class CollectController extends Controller
{
    public function actionAdd()
    {
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'pkgId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'noteId');

        $modelLogicAddCollect = new ModelLogicAddCollect();
        $modelLogicAddCollect->execute($pkgId, $noteId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionAddPkg()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $pkgName = ParameterValidatorHelper::validateString($_POST, 'pkgName');

        $modelLogicAddPkg = new ModelLogicAddPkg();
        $ret = $modelLogicAddPkg->execute($userId, $pkgName);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionDel()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'noteId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'pkgId');

        $modelLogicDelCollect = new ModelLogicDelCollect();
        $modelLogicDelCollect->execute($userId, $noteId, $pkgId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionEditPkg()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'pkgId');
        $pkgName = ParameterValidatorHelper::validateString($_POST, 'pkgName');

        $modelLogicEditPkg = new ModelLogicEditPkg();
        $modelLogicEditPkg->execute($userId, $pkgId, $pkgName);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionPkgList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');

        $modelLogicPkgList = new ModelLogicPkgList();
        $ret = $modelLogicPkgList->execute($userId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'pkgId');

        $modelLogicCollectFetch = new ModelLogicCollectFetch($userId, $pkgId);
        $ret = $modelLogicCollectFetch->execute($userId, $pkgId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

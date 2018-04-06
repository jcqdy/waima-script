<?php

class CollectController extends Controller
{
    public function actionAdd()
    {
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'pkgId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');

        $modelLogicAddCollect = new ModelLogicAddCollect();
        $modelLogicAddCollect->execute($pkgId, $noteId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionAddPkg()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $pkgName = ParameterValidatorHelper::validateString($_REQUEST, 'pkgName');

        $modelLogicAddPkg = new ModelLogicAddPkg();
        $ret = $modelLogicAddPkg->execute($userId, $pkgName);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionDel()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $noteId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'noteId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'pkgId');

        $modelLogicDelCollect = new ModelLogicDelCollect();
        $modelLogicDelCollect->execute($userId, $noteId, $pkgId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionEditPkg()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'pkgId');
        $pkgName = ParameterValidatorHelper::validateString($_REQUEST, 'pkgName');

        $modelLogicEditPkg = new ModelLogicEditPkg();
        $modelLogicEditPkg->execute($userId, $pkgId, $pkgName);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionPkgList()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicPkgList = new ModelLogicPkgList();
        $ret = $modelLogicPkgList->execute($userId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionFetch()
    {
        $sp = ParameterValidatorHelper::validateInteger($_REQUEST, 'sp', 0);
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num', 1, 20, 20);
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $pkgId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'pkgId');

        $modelLogicCollectFetch = new ModelLogicCollectFetch();
        $ret = $modelLogicCollectFetch->execute($userId, $pkgId, $sp, $num);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

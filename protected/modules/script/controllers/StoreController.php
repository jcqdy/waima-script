<?php
class StoreController extends Controller
{
    public function actionIndex()
    {
        $modelLogicStoreHome = new ModelLogicStoreHome();
        $ret = $modelLogicStoreHome->execute();

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

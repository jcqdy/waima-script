<?php
class StoreController extends Controller
{
    public function actionIndex()
    {
        $modelLogicStoreHome = new ModelLogicStoreHome();
        $ret = $modelLogicStoreHome->execute();

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

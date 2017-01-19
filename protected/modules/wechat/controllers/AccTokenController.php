<?php
class AccTokenController extends Controller
{
    /**
     * 获取微信AccessToken
     *
     * @throws Exception
     */
    public function actionIndex()
    {
        $modelLogicAccToken = new ModelLogicAccToken();
        $accToken = $modelLogicAccToken->execute();

        ResponseHelper::outputJsonV2(['accessToken' => $accToken], 'ok', 200);
    }
}

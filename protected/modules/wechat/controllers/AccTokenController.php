<?php
class AccTokenController extends H5Controller
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

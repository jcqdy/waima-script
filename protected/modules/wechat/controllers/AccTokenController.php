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
        $accToken = $modelLogicAccToken->accToken();

        ResponseHelper::outputJsonApp(['accessToken' => $accToken], 'ok', 200);
    }

    public function actionSig()
    {
        $url = ParameterValidatorHelper::validateString($_REQUEST, 'url');

        $modelLogicAccToken = new ModelLogicAccToken();
        $ret = $modelLogicAccToken->ticketData($url);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionFake()
    {
        $obj = new FakeData();
        $obj->moreScript();
    }
}

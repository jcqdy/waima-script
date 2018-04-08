<?php
class LoginController extends H5Controller
{
    public function actionOpenId()
    {
        $code = ParameterValidatorHelper::validateString($_REQUEST, 'code');

        $modelLogicLogin = new ModelLogicLogin();
        $ret = $modelLogicLogin->openId($code);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }
}

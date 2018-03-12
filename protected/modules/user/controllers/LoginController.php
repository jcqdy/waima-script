<?php
class LoginController extends H5Controller
{
    public function actionOpenId()
    {
        $code = ParameterValidatorHelper::validateString($_POST, 'code');

        $modelLogicLogin = new ModelLogicLogin();
        $ret = $modelLogicLogin->openId($code);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }
}

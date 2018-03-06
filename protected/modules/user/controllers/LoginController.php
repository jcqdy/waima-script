<?php
class LoginController extends H5Controller
{
    public function actionOpenId()
    {
        $code = ParameterValidatorHelper::validateString($_POST, 'code');

        $modelLogicLogin = new ModelLogicLogin();
    }
}

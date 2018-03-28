<?php

class UserController extends Controller
{
    public function actionAdd()
    {
        $openId = ParameterValidatorHelper::validateString($_REQUEST, 'openId');
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $nickName = ParameterValidatorHelper::validateString($_REQUEST, 'nickName');
        $avatarUrl = ParameterValidatorHelper::validateString($_REQUEST, 'avatarUrl');
        $gender = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'gender', [1,2,0]);
        $city = ParameterValidatorHelper::validateString($_REQUEST, 'city');
        $province = ParameterValidatorHelper::validateString($_REQUEST, 'province');
        $country = ParameterValidatorHelper::validateString($_REQUEST, 'country');
        $language = ParameterValidatorHelper::validateString($_REQUEST, 'language');

        $modelLogicAddUser = new ModelLogicAddUser();
        $ret = $modelLogicAddUser->execute($openId, $userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicAddUser = new ModelLogicFetchUser();
        $ret = $modelLogicAddUser->execute($userId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionReadRecord()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicReadRecord = new ModelLogicReadRecord();
        $modelLogicReadRecord->execute($userId, $scriptId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionEdit()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $phoneNum = ParameterValidatorHelper::validateString($_REQUEST, 'phoneNum', null, null, '');
        $avatarUrl = ParameterValidatorHelper::validateString($_REQUEST, 'avatarUrl', null, null, '');
        $nickName = ParameterValidatorHelper::validateString($_REQUEST, 'nickName', null, null, '');

        $modelLogicEditUser = new ModelLogicEditUser();
        $modelLogicEditUser->execute($userId, $phoneNum, $avatarUrl, $nickName);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    
}

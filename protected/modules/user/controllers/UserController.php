<?php

class UserController extends Controller
{
    public function actionAdd()
    {
        $nickName = ParameterValidatorHelper::validateString($_POST, 'nickName');
        $avatarUrl = ParameterValidatorHelper::validateString($_POST, 'avatarUrl');
        $gender = ParameterValidatorHelper::validateEnumInteger($_POST, 'gender', [1,2,0]);
        $city = ParameterValidatorHelper::validateString($_POST, 'city');
        $province = ParameterValidatorHelper::validateString($_POST, 'province');
        $country = ParameterValidatorHelper::validateString($_POST, 'country');
        $language = ParameterValidatorHelper::validateString($_POST, 'language');

        $modelLogicAddUser = new ModelLogicAddUser();
        $ret = $modelLogicAddUser->execute($nickName, $avatarUrl, $gender, $city, $province, $country, $language);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');

        $modelLogicAddUser = new ModelLogicFetchUser();
        $ret = $modelLogicAddUser->execute($userId);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionReadRecord()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'scriptId');

        $modelLogicReadRecord = new ModelLogicReadRecord();
        $modelLogicReadRecord->execute($userId, $scriptId);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionEdit()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_POST, 'userId');
        $phoneNum = ParameterValidatorHelper::validateString($_POST, 'phoneNum', null, null, null);
        $avatarUrl = ParameterValidatorHelper::validateString($_POST, 'avatarUrl', null, null, null);
        $nickName = ParameterValidatorHelper::validateString($_POST, 'nickName', null, null, null);

        $modelLogicEditUser = new ModelLogicEditUser();
        $modelLogicEditUser->execute($userId, $phoneNum, $avatarUrl, $nickName);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    
}

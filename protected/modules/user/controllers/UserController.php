<?php

class UserController extends Controller
{
    public function actionAdd()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $nickName = ParameterValidatorHelper::validateString($_REQUEST, 'nickName', null, null, '');
        $avatarUrl = ParameterValidatorHelper::validateString($_REQUEST, 'avatarUrl', null, null, '');
        $gender = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'gender', [1,2,0], 3);
        $city = ParameterValidatorHelper::validateString($_REQUEST, 'city', null, null, '');
        $province = ParameterValidatorHelper::validateString($_REQUEST, 'province', null, null, '');
        $country = ParameterValidatorHelper::validateString($_REQUEST, 'country', null, null, '');
        $language = ParameterValidatorHelper::validateString($_REQUEST, 'language', null, null, '');
        $phoneNum = ParameterValidatorHelper::validateString($_REQUEST, 'phoneNum', null, null, '');

        $modelLogicAddUser = new ModelLogicAddUser();
        $ret = $modelLogicAddUser->execute($userId, $nickName, $avatarUrl, $gender, $city, $province, $country, $language, $phoneNum);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionFetch()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');

        $modelLogicAddUser = new ModelLogicFetchUser();
        $ret = $modelLogicAddUser->execute($userId);

        ResponseHelper::outputJsonApp($ret, 'ok', 200);
    }

    public function actionReadRecord()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $scriptId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'scriptId');

        $modelLogicReadRecord = new ModelLogicReadRecord();
        $modelLogicReadRecord->execute($userId, $scriptId);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    public function actionEdit()
    {
        $userId = ParameterValidatorHelper::validateMongoIdAsString($_REQUEST, 'userId');
        $phoneNum = ParameterValidatorHelper::validateString($_REQUEST, 'phoneNum', null, null, '');
        $avatarUrl = ParameterValidatorHelper::validateString($_REQUEST, 'avatarUrl', null, null, '');
        $nickName = ParameterValidatorHelper::validateString($_REQUEST, 'nickName', null, null, '');

        $modelLogicEditUser = new ModelLogicEditUser();
        $modelLogicEditUser->execute($userId, $phoneNum, $avatarUrl, $nickName);

        ResponseHelper::outputJsonApp([], 'ok', 200);
    }

    
}

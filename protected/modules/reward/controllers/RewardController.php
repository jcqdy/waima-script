<?php
class RewardController extends H5Controller
{
    public function actionGuide()
    {
        $modelLogicReward = new ModelLogicReward();
        $ret = $modelLogicReward->guid();

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionSubmit()
    {
        $workName = ParameterValidatorHelper::validateString($_REQUEST, 'workName');
        $type = ParameterValidatorHelper::validateEnumInteger($_REQUEST, 'type', [1, 2, 3]);
        $money = ParameterValidatorHelper::validateInteger($_REQUEST, 'money', 1000);
        
        $modelLogicReward = new ModelLogicReward();
        $modelLogicReward->submit($workName, $type, $money);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionSearch()
    {
        $workName = ParameterValidatorHelper::validateString($_REQUEST, 'workName');

        $modelLogicReward = new ModelLogicReward();
        $ret = $modelLogicReward->search($workName);

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionStat()
    {
        $page = ParameterValidatorHelper::validateInteger($_REQUEST, 'page');
        $type = ParameterValidatorHelper::validateString($_REQUEST, 'type');

        $modelLogicReward = new ModelLogicReward();
        $modelLogicReward->stat($page, $type);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }
}

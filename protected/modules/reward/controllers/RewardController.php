<?php
class RewardController extends H5Controller
{
    public function actionGuide()
    {
        $modelLogicReward = new ModelLogicReward();
        $ret = $modelLogicReward->guide();

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
        $page = ParameterValidatorHelper::validateString($_REQUEST, 'page');
        $type = ParameterValidatorHelper::validateString($_REQUEST, 'type');

        $modelLogicReward = new ModelLogicReward();
        $modelLogicReward->stat($page, $type);

        ResponseHelper::outputJsonV2([], 'ok', 200);
    }

    public function actionNewShare()
    {
        $modelLogicReward = new ModelLogicReward();
        $ret = $modelLogicReward->newShare();

        ResponseHelper::outputJsonV2($ret, 'ok', 200);
    }

    public function actionStata()
    {
        $num = ParameterValidatorHelper::validateInteger($_REQUEST, 'num');
        $aNum = ParameterValidatorHelper::validateInteger($_REQUEST, 'aNum');

        $movieDir = "../../../../public/movie.txt";
        $tvDir = "../../../../public/tv.txt";

        $modelDaoReward = new ModelDaoReward();

        $fhandle = fopen($movieDir, "r");
        if ($fhandle) {
            while (! feof($fhandle)) {
                $workName = fgets($fhandle);
                $ret = $modelDaoReward->queryByWorkName($workName);
                if (! empty($ret)) {
                    continue;
                }
                $a = false;
                if (strpos($workName, '<a>') !== false) {
                    $rep = rand(0, 1);
                    $a = true;
                } else {
                    $rep = rand(1, 3);
                }

                for ($i = 0; $i < $rep; $i++) {
                    // A集影视,做特殊处理
                    $injury = $a == false ? $num : $aNum;
                    // 1/3的概率设置假数据
                    if (rand(0, 100) < $injury) {
                        // 随机出假稿酬
                        $max = $a == false ? rand(7, 20) : rand(15, 70);
                        $money = $a == false ? rand(3, $max) * 10000 : $max * 10000;
                    } else {
                        continue;
                    }

                    $modelDaoReward->addReward($money, $workName, 1, 2);
                }
            }
        }
        fclose($fhandle);

        $fhandle = fopen($tvDir, "r");
        if ($fhandle) {
            while (! feof($fhandle)) {
                $workName = fgets($fhandle);
                $ret = $modelDaoReward->queryByWorkName($workName);
                if (! empty($ret)) {
                    continue;
                }
                $a = false;
                if (strpos($workName, '<a>') !== false) {
                    $rep = rand(0, 1);
                    $a = true;
                } else {
                    $rep = rand(1, 3);
                }

                for ($i = 0; $i < $rep; $i++) {
                    // A集影视,做特殊处理
                    $injury = $a == false ? $num : $aNum;
                    // 1/3的概率设置假数据
                    if (rand(0, 100) < $injury) {
                        // 随机出假稿酬
                        $max = $a == false ? rand(5, 13) : rand(5, 18);
                        $money = $a == false ? rand(1, $max) * 10000 : $max * 10000;
                    } else {
                        continue;
                    }
                    $modelDaoReward->addReward($money, $workName, 2, 2);
                }
            }
        }
        fclose($fhandle);
    }
}

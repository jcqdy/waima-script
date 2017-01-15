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

    public function actionStata()
    {
        $movieDir = '/home/worker/data/www/waima-op/public/movie.txt';
        $tvDir = '/home/worker/data/www/waima-op/public/tv.txt';

        $modelDaoReward = new ModelDaoReward();

        $fhandle = fopen($movieDir, "r");
        if ($fhandle) {
            while (! feof($fhandle)) {
                $workName = fgets($fhandle);
                $workName = str_replace("\n","",$workName);
                $ret = $modelDaoReward->queryByWorkName($workName);
                if (! empty($ret)) {
                    continue;
                }
                $rep = rand(1, 3);

                for ($i = 0; $i < $rep; $i++) {
                    // 1/5的概率设置假数据
                    if (rand(0, 100) < 20) {
                        // 随机出假稿酬
                        $max = rand(7, 20);
                        $money = rand(3, $max) * 10000;
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
                $workName = str_replace("\n","",$workName);
                $ret = $modelDaoReward->queryByWorkName($workName);
                if (! empty($ret)) {
                    continue;
                }
                $rep = rand(1, 3);

                for ($i = 0; $i < $rep; $i++) {
                    // 1/3的概率设置假数据
                    if (rand(0, 100) < 20) {
                        // 随机出假稿酬
                        $max = rand(5, 13);
                        $money = rand(1, $max) * 10000;
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

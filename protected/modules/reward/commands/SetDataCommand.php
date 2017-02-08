<?php
class SetDataCommand extends ConsoleCommand
{
    public function actionSetWork()
    {


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
                $rep = rand(1, 3);

                for ($i = 0; $i < $rep; $i++) {
                    // 1/3的概率设置假数据
                    if (rand(0, 100) < 30) {
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
                $ret = $modelDaoReward->queryByWorkName($workName);
                if (! empty($ret)) {
                    continue;
                }
                $rep = rand(1, 3);

                for ($i = 0; $i < $rep; $i++) {
                    // 1/3的概率设置假数据
                    if (rand(0, 100) < 30) {
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

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
                $a = false;
                if (strpos($workName, '<a>') !== false) {
                    $rep = rand(0, 1);
                    $a = true;
                } else {
                    $rep = rand(1, 3);
                }

                for ($i = 0; $i < $rep; $i++) {
                    // A集影视,做特殊处理
                    $injury = $a == false ? 30 : 10;
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
                    $injury = $a == false ? 30 : 10;
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

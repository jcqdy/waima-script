<?php

class RecordCommand extends CConsoleCommand
{
    protected $ratios = [];

    public function actionRanking()
    {
        $modelDaoUser = new ModelDaoUser();
        $readNumList = $readDaysList = [];
        $cur = $modelDaoUser->find();
        while ($cur->hasNext()) {
            $user = $cur->getNext();
            $readNumList[(string)$user['_id']] = $user['readNum'];
            $readDaysList[(string)$user['_id']] = $user['readDays'];
        }

        asort($readNumList);
        asort($readDaysList);
        $readDaysVals = array_values($readDaysList);

        $readNumCount = count($readNumList);
        $readDaysCount = count($readDaysList);

        $n = 0;
        foreach ($readNumList as $uid => $num) {
            $n++;
            if ($num == 0) {
                $readNumRatio = 0;
                continue;
            }

            if ($n >= $readNumCount * 0.7) {
                $readNumRatio = rand(60, 90) / 100;
            } elseif ($n < $readNumCount * 0.7 && $n >= $readNumCount * 0.3) {
                $readNumRatio = rand(30, 60) / 100;
            } elseif ($n < $readNumCount * 0.3) {
                $readNumRatio = rand(10, 30) / 100;
            }

            $readDay = $readDaysList[$uid];
            $m = array_search($readDay, $$readDaysVals) + 1;

            if ($n >= $readDaysCount * 0.7) {
                $readDayRatio = rand(60, 90) / 100;
            } elseif ($n < $readDaysCount * 0.7 && $n >= $readDaysCount * 0.3) {
                $readDayRatio = rand(30, 60) / 100;
            } elseif ($n < $readDaysCount * 0.3) {
                $readDayRatio = rand(10, 30) / 100;
            }

            $modelDaoUser->updateRatio($uid, $readNumRatio, $readDayRatio);
        }
    }

    public function actionA()
    {
        $modelDaoUser = new ModelDaoUser();
        $modelDaoUser->add(['a' => 1]);
    }
}

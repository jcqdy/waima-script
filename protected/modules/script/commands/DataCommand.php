<?php

class DataCommand extends ConsoleCommand
{
    public $types = [
        '剧情','爱情','喜剧','科幻','动作','悬疑','犯罪','恐怖','青春','励志','战争',
        '文艺','黑色','幽默','传记','暴力','家庭',
    ];

    public $arr = [
        '5aa7b5f650cc87a43507d3ca' => "为奴十二年",
        '5aa7b5f650cc87a43507d3cb' => "乌云背后的幸福线",
        '5aa7b5f950cc87a43507d3e8' => "入殓师",
        '5aa7b5fb50cc87a43507d3f9' => "出租车司机",
        '5aa7b5fd50cc87a43507d402' => "十二怒汉",
        '5aa7b5fd50cc87a43507d407' => "华尔街",
        '5aa7b5fe50cc87a43507d40e' => "变脸",
        '5aa7b60450cc87a43507d43b' => "天才枪手",
        '5aa7b60450cc87a43507d43c' => "天才瑞普利",
        '5aa7b60f50cc87a43507d496' => "拆弹部队",
        '5aa7b60850cc87a43507d464' => "帝国的毁灭",
        '5aa7b60f50cc87a43507d49f' => "教父2",
        '5aa7b61050cc87a43507d4a2' => "断背山",
        '5aa7b61050cc87a43507d4a9' => "无间道风云",
        '5aa7b61350cc87a43507d4bb' => "朗读者",
        '5aa7b61350cc87a43507d4be' => "末代皇帝",
        '5aa7b61350cc87a43507d4c0' => "本杰明·巴顿奇事",
        '5aa7b61350cc87a43507d4c2' => "杀人回忆",
        '5aa7b61450cc87a43507d4c8' => "林肯",
        '5aa7b61650cc87a43507d4da' => "沉默的羔羊",
        '5aa7b61650cc87a43507d4dc' => "泰囧",
        '5aa7b61550cc87a43507d4d1' => "死亡诗社",
        '5aa7b61750cc87a43507d4e4' => "海上钢琴师",
        '5aa7b61a50cc87a43507d4fe' => "猜火车",
        '5aa7b61c50cc87a43507d512' => "盲山",
        '5aa7b61e50cc87a43507d51b' => "社交网络",
        '5aa7b61e50cc87a43507d521' => "穆赫兰道",
        '5aa7b61e50cc87a43507d522' => "穿普拉达的女王",
        '5aa7b62250cc87a43507d540' => "美国丽人",
        '5aa7b62250cc87a43507d541' => "美国往事",
        '5aa7b62450cc87a43507d549' => "老无所依",
        '5aa7b62450cc87a43507d54d' => "肖申克的救赎",
        '5aa7b62550cc87a43507d55a' => "英国病人",
        '5aa7b62750cc87a43507d569' => "血钻",
        '5aa7b62750cc87a43507d56d' => "被解救的姜戈",
        '5aa7b62850cc87a43507d570' => "西游降魔篇",
        '5aa7b62850cc87a43507d571' => "西雅图未眠夜",
        '5aa7b62950cc87a43507d57c' => "贫民窟的百万富翁",
        '5aa7b62a50cc87a43507d585' => "辛德勒的名单",
        '5aa7b62b50cc87a43507d590' => "逃离德黑兰",
        '5aa7b62c50cc87a43507d594' => "遗愿清单",
        '5aa7b62a50cc87a43507d589' => "迷失东京",
        '5aa7b62150cc87a43507d537' => "绿里奇迹",
        '5aa7b62250cc87a43507d53e' => "美丽人生",
        '5aa7b62250cc87a43507d53f' => "美丽心灵",
        '5aa7b62c50cc87a43507d598' => "醉乡民谣",
        '5aa7b62e50cc87a43507d5a9' => "闻香识女人",
        '5aa7b62e50cc87a43507d5ac' => "阳光小美女",
        '5aa7b62e50cc87a43507d5ae' => "阿甘正传",
        '5aa7b63050cc87a43507d5ba' => "霸王别姬",
        '5aa7b63150cc87a43507d5bd' => "非凡任务",
        '5aa7b63150cc87a43507d5be' => "非常嫌疑犯",
        '5aa7b63150cc87a43507d5c3' => "飞越疯人院",
        '5aa7b63250cc87a43507d5ca' => "魂断蓝桥",
        '5aa7b63350cc87a43507d5d6' => "黑衣人",
        "5aa7b5f650cc87a43507d3cc" => "乘风破浪",
        "5aa7b5f650cc87a43507d3c6" => "两杆大烟枪",
        "5a9cd42150cc87f908cde1b3" => "低俗小说",
        "5aa7b5f350cc87a43507d3b0" => "七月与安生",
        "5aa7b5f450cc87a43507d3b5" => "三块广告牌",
        "5aa7b5fc50cc87a43507d3fa" => "出租车司机-韩版",
        "5aa7b5ff50cc87a43507d41b" => "唐人街探案",
        "5aa7b60050cc87a43507d420" => "嘉年华",
        "5aa7b60150cc87a43507d425" => "国王的演讲",
        "5aa7b60650cc87a43507d44f" => "嫌疑人X的献身",
        "5aa7b60750cc87a43507d456" => "寻梦环游记",
        "5aa7b60f50cc87a43507d49e" => "教父",
        "5aa7b61050cc87a43507d4a0" => "敦刻尔克",
        "5aa7b61850cc87a43507d4ed" => "火锅英雄",
        "5aa7b61850cc87a43507d4f1" => "熔炉",
        "5aa7b61c50cc87a43507d511" => "盗梦空间",
        "5aa7b61d50cc87a43507d513" => "相亲相爱",
        "5aa7b61d50cc87a43507d515" => "看不见的客人",
        "5aa7b62350cc87a43507d546" => "羞羞的铁拳",
        "5aa7b62450cc87a43507d54b" => "老炮儿",
        "5aa7b62850cc87a43507d575" => "记忆大师",
        "5aa7b62a50cc87a43507d586" => "达拉斯买家俱乐部",
        "5aa7b62c50cc87a43507d596" => "那些年，我们一起追的女孩",
        "5aa7b62d50cc87a43507d59d" => "金刚狼3",
        "5aa7b63350cc87a43507d5d1" => "黄海",
        "5aa7b63350cc87a43507d5d2" => "黑天鹅",
        "5aa7b62f50cc87a43507d5b4" => "雄狮",
    ];

    public function actionA()
    {
        $modelDaoScript = new ModelDaoScript();
        foreach ($this->arr as $id => $v) {
            $data = $modelDaoScript->findOne(["_id" => new MongoId($id)]);
            $readerNum = $data['set']['readerNum'];
            $doc = [
                '$unset' => ['set' => 1],
                '$set' => ['readerNum' => $readerNum],
            ];

            $modelDaoScript->update(['_id' => new MongoId($id)], $doc);
        }
    }


    public function actionFake0()
    {
        $modelDaoScriptType = new ModelDaoScriptType();
        $modelDaoScript = new ModelDaoScript();
        $scFileDir = '/home/worker/data/剧本新';
        $sf = '/home/worker/data/剧本新';
        $qrdir = '/home/worker/data/qrcode/';
        $fileNames = scandir($scFileDir);
        unset($fileNames[0], $fileNames[1], $fileNames[2]);
        $urlPrefix = Yii::app()->params['qiniu_prefix'];

        foreach ($fileNames as $name) {
            $dbData = ['name' => $name, 'readerNum' => rand(1200, 1900), 'createTime' => time() - rand(99, 9999)];
            LogHelper::error($name . ' start');

            $cons = scandir($scFileDir.'/'.$name);
            foreach ($cons as $n) {
                if (strpos($n, 'cover') !== false) {
//                    $cover = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $etag = QiniuHelper::uploadFile($scFileDir.'/'.$name.'/'.$n);
                    if ($etag === false)
                        continue;
                    $dbData['coverUrl'] = $etag;
                    LogHelper::error($name . " cover upload success ; coverUrl : " . $dbData['coverUrl'] . "\n");
                    continue;
                }
                if (strpos($n, $name) !== false) {
                    $etag = QiniuHelper::uploadFile($scFileDir.'/'.$name.'/'.$n);
                    if ($etag === false)
                        continue;
                    $dbData['fileUrl'] = $etag;
                    LogHelper::error($name . " script upload success ; fileUrl : " . $dbData['fileUrl'] . "\n");
                }
                if (strpos($n, 'data') !== false) {
                    $data = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;
                        //  处理剧本类型
                        if (in_array($val, $this->types)) {
                            $res = $modelDaoScriptType->findOne(['name' => $val]);
                            if (empty($res)) {
                                $typeId = new MongoId();
                                $modelDaoScriptType->add(['_id' => $typeId, 'name' => $val, 'eName' => '', 'scriptNum' => 99, 'coverUrl' => 'comdeyCover']);
                            } else {
                                $typeId = $res['_id'];
                            }
                            $dbData['typeIds'][] = (string)$typeId;
                            $dbData['scriptType'][] = $val;
                        } else {
                            $dbData['writer'][] = $val;
                        }
                    }
                    LogHelper::error($name . " data  \n");
                }
            }

//            $qretag = QiniuHelper::uploadFile($qrdir.$name);
//            if ($qretag === false)
//                LogHelper::error($name . ' upload qrcode failed');
//
//            $dbData['qrcodeUrl'] = $qretag;
            $modelDaoScript->add($dbData);
        }

    }

    public function actionFake()
    {
        $modelDaoScriptType = new ModelDaoScriptType();
        $modelDaoScript = new ModelDaoScript();
        $scFileDir = '/home/worker/data/剧本';
        $fileNames = scandir($scFileDir);
        unset($fileNames[0], $fileNames[1], $fileNames[2]);
        $urlPrefix = Yii::app()->params['qiniu_prefix'];

        foreach ($fileNames as $name) {
            $dbData = ['name' => $name, 'readerNum' => rand(3, 99), 'createTime' => time() - rand(99, 999999)];
            $cons = scandir($scFileDir.'/'.$name);
            foreach ($cons as $n) {
                if (strpos($n, 'cover') !== false) {
//                    $cover = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $etag = QiniuHelper::uploadFile($scFileDir.'/'.$name.'/'.$n);
                    if ($etag === false)
                        continue;
                    $dbData['coverUrl'] = $etag;
                    echo $name . " cover upload success ; coverUrl : " . $dbData['coverUrl'] . "\n";
                    continue;
                }
                if (strpos($n, $name) !== false) {
                    $etag = QiniuHelper::uploadFile($scFileDir.'/'.$name.'/'.$n);
                    if ($etag === false)
                        continue;
                    $dbData['fileUrl'] = $etag;
                    echo $name . " script upload success ; fileUrl : " . $dbData['fileUrl'] . "\n";
                }
                if (strpos($n, 'data') !== false) {
                    $data = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;
                        //  处理剧本类型
                        if (in_array($val, $this->types)) {
                            $res = $modelDaoScriptType->findOne(['name' => $val]);
                            if (empty($res)) {
                                $typeId = new MongoId();
                                $modelDaoScriptType->add(['_id' => $typeId, 'name' => $val, 'eName' => '', 'scriptNum' => 99, 'coverUrl' => 'comdeyCover']);
                            } else {
                                $typeId = $res['_id'];
                            }
                            $dbData['typeIds'][] = (string)$typeId;
                            $dbData['scriptType'][] = $val;
                        } else {
                            $dbData['writer'][] = $val;
                        }
                    }
                    echo $name . " data  \n";
                }
            }
            $modelDaoScript->add($dbData);
        }

    }

    public function actionFake2()
    {
        $scFileDir = '/home/worker/data/剧本/';
        $dir = '/home/worker/data/修改剧本/';
        $modelDaoScript = new ModelDaoScript();
        $cur = $modelDaoScript->find();
        while ($cur->hasNext()) {
            $data = $cur->getNext();
            if ($data['name'] !== '低俗小说')
                continue;

            $script = file_get_contents($scFileDir.$data['name'].'/'.$data['name']);
            if (empty($script)) {
                LogHelper::error('file_get_contents error : '.$data['name']);
                continue;
            }

            $scriptArr = explode('<br>', $script);

            foreach ($scriptArr as $key => $line) {
                if (empty($line))
                    continue;

                if (strpos($line, '<span>') !== false) {
                    if (strpos($line, '<span><span>') !== false) {
                        $scriptArr[$key] = str_replace('<span><span>', '<span class="subtitle">', $line);
                    } else {
                        $scriptArr[$key] = str_replace('<span>', '<span class="subtitle">', $line);
                    }
                    continue;
                }

                $scriptArr[$key] = '<span class="text">' . $line . '</span>';
            }

            $newScript = implode('<br>', $scriptArr);
            file_put_contents($dir . $data['name'], $newScript);

            $etag = QiniuHelper::uploadFile($dir . $data['name']);
            if ($etag == false) {
                LogHelper::error('剧本上传失败: ' . $data['name']);
                continue;
            }

            $modelDaoScript->modify(['_id' => $data['_id']], ['fileUrl' => $etag]);
            LogHelper::error($data['name'] . ' 成功');
        }
    }

    public function actionFormat()
    {
        $dir = '/home/worker/data/修改剧本2/';
        $modelDaoScript = new ModelDaoScript();
        $cur = $modelDaoScript->find();
        $urlPrefix = Yii::app()->params['qiniu_prefix'];

        while ($cur->hasNext()) {
            $data = $cur->getNext();
            $fileUrl = $urlPrefix.$data['fileUrl'];
            $script = file_get_contents($fileUrl);
            if (empty($script)) {
                LogHelper::error($data['name'] . ' is empty');
                continue;
            }

            if (is_array(json_decode($script, true))) {
                LogHelper::error($data['name'] . ' is json');
                continue;
            }

            $newArr = ['data' => []];
            $scriptArr = explode('<br>', $script);
            foreach ($scriptArr as $key => $val) {
                $item = [];
                if (strpos($val, '<span class="text">') !== false) {
                    $val = str_replace('<span class="text">', '', $val);
                }
                if (strpos($val, '</span>') !== false) {
                    $val = str_replace('</span>', '', $val);
                }
                if (strpos($val, '<span class="subtitle">') !== false) {
                    $item['title'] = 1;
                    $val = str_replace('<span class="subtitle">', '', $val);
                }
                $item['text'] = mb_convert_encoding($val, "UTF-8");
                $newArr['data'][] = $item;
            }

            file_put_contents($dir . $data['name'], json_encode($newArr, JSON_UNESCAPED_UNICODE));

            $etag = QiniuHelper::uploadFile($dir . $data['name']);
            if ($etag == false) {
                LogHelper::error('剧本上传失败: ' . $data['name']);
                continue;
            }

            $modelDaoScript->modify(['_id' => $data['_id']], ['fileUrl' => $etag]);
            LogHelper::error($data['name'] . ' success');
        }
    }
}

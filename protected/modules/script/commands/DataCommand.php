<?php

class DataCommand extends ConsoleCommand
{
    public $types = [
        '剧情','爱情','喜剧','科幻','动作','悬疑','犯罪','恐怖','青春','励志','战争',
        '文艺','黑色','幽默','传记','暴力','家庭',
    ];

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

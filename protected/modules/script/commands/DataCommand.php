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
                    $cover = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $etag = QiniuHelper::uploadPic(base64_encode($cover));
                    if ($etag === false)
                        continue;
                    $dbData['coverUrl'] = $etag;
                    continue;
                }
                if (strpos($n, $name) !== false) {
//                    $script = file_get_contents($scFileDir.'/'.$name.'/'.$n);
                    $etag = QiniuHelper::uploadFile($scFileDir.'/'.$name.'/'.$n, $name.time());
                    if ($etag === false)
                        continue;
                    $dbData['fileUrl'] = $etag;
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
                            $dbData['typeIds'][] = $typeId;
                            $dbData['scriptType'][] = $val;
                        } else {
                            $dbData['writer'][] = $val;
                        }
                    }
                }
            }
            $modelDaoScript->add($dbData);
        }

    }

    public function actionA()
    {

    }
}

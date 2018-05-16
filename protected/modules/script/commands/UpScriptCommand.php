<?php
class UpScriptCommand extends CConsoleCommand
{
    public $types = [
        '剧情','爱情','喜剧','科幻','动作','悬疑','犯罪','恐怖','青春','励志','战争',
        '文艺','黑色','幽默','传记','暴力','家庭',
    ];

    public function actionAdd($fileDir)
    {
        $modelDaoScriptType = new ModelDaoScriptType();
        $modelDaoScript = new ModelDaoScript();

        $dirNames = scandir($fileDir);
        foreach ($dirNames as $k => $name) {
            if (in_array($name, ['.', '..', '.DS_Store'])) {
                unset($dirNames[$k]);
            }
        }

        // 遍历每个剧本的文件夹
        foreach ($dirNames as $name) {
            $scriptId = new MongoId();
            $dbData = ['_id' => $scriptId, 'name' => $name, 'readerNum' => rand(1200, 1900), 'createTime' => time() - rand(99, 9999)];
            LogHelper::error($name . ' start');

            $fileName = scandir($fileDir.'/'.$name);

            // 遍历某个剧本文件下的内容
            foreach ($fileName as $file) {

                $arr = explode(".", $file);
                // 处理剧本封面
                if (in_array(
                    strtolower(end($arr)),
                    ['png', 'jpg', 'jpeg']
                )) {
                    $etag = QiniuHelper::uploadFile($fileDir . '/' . $name . '/' . $file);
                    if ($etag === false)
                        continue;
                    $dbData['coverUrl'] = $etag;
                    LogHelper::error($name . " cover upload success ; coverUrl : " . $dbData['coverUrl'] . "\n");
                    continue;
                }

                // 处理剧本文件
                if ($file == $name) {
                    $etag = QiniuHelper::uploadFile($fileDir . '/' . $name . '/' . $file);
                    if ($etag === false)
                        continue;
                    $dbData['fileUrl'] = $etag;
                    LogHelper::error($name . " script upload success ; fileUrl : " . $dbData['fileUrl'] . "\n");
                }

                // 处理剧本类型文件
                if ($file == 'type') {
                    $data = file_get_contents($fileDir . '/' . $name . '/' . $file);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;

                        if (in_array($val, $this->types)) {
                            $res = $modelDaoScriptType->findOne(['name' => $val]);
                            if (empty($res)) {
                                continue;
                            } else {
                                $typeId = $res['_id'];
                            }
                            $dbData['typeIds'][] = (string)$typeId;
                            $dbData['scriptType'][] = $val;
                        }
                    }
                    LogHelper::error($name . " type  \n");
                }

                // 处理剧本编剧文件
                if ($file == 'writer') {
                    $data = file_get_contents($fileDir . '/' . $name . '/' . $file);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;

                        $dbData['writer'][] = $val;
                    }
                    LogHelper::error($name . " writer  \n");
                }

                $qrcode = $this->qrcode((string)$scriptId, $name, $fileDir);
                if ($qrcode != false) {
                    $dbData['qrcodeUrl'] = $qrcode;
                }

            }
            $modelDaoScript->add($dbData);
        }
    }

    /**
     * 更新剧本某个信息
     *
     * @param $fileDir 剧本信息文件夹
     * @param $item 要更新的字段
     */
    public function actionUpdate($fileDir, $item)
    {
        $modelDaoScriptType = new ModelDaoScriptType();
        $modelDaoScript = new ModelDaoScript();

        $dirNames = scandir($fileDir);
        foreach ($dirNames as $k => $name) {
            if (in_array($name, ['.', '..', '.DS_Store'])) {
                unset($dirNames[$k]);
            }
        }

        // 遍历每个剧本的文件夹
        foreach ($dirNames as $name) {
            $script = $modelDaoScript->findOne(['name' => $name]);
            if (empty($script))
                continue;

            $fileName = scandir($fileDir.'/'.$name);

            // 遍历某个剧本文件下的内容
            foreach ($fileName as $file) {
                $dbData = [];
                // 处理剧本封面
                if ($item == 'cover') {
                    $arr = explode(".", $file);
                    if (in_array(
                        strtolower(end($arr)),
                        ['png', 'jpg', 'jpeg']
                    )) {
                        $etag = QiniuHelper::uploadFile($fileDir . '/' . $name . '/' . $file);
                        if ($etag === false)
                            continue;
                        $dbData['coverUrl'] = $etag;
                        LogHelper::error($name . " cover upload success ; coverUrl : " . $dbData['coverUrl'] . "\n");
                        continue;
                    }
                }

                // 处理剧本文件
                if ($file == $name && $item == 'script') {
                    $etag = QiniuHelper::uploadFile($fileDir . '/' . $name . '/' . $file);
                    if ($etag === false)
                        continue;
                    $dbData['fileUrl'] = $etag;
                    LogHelper::error($name . " script upload success ; fileUrl : " . $dbData['fileUrl'] . "\n");
                }

                // 处理剧本类型文件
                if ($file == 'type' && $item == 'type') {
                    $data = file_get_contents($fileDir . '/' . $name . '/' . $file);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;

                        if (in_array($val, $this->types)) {
                            $res = $modelDaoScriptType->findOne(['name' => $val]);
                            if (empty($res)) {
                                continue;
                            } else {
                                $typeId = $res['_id'];
                            }
                            $dbData['typeIds'][] = (string)$typeId;
                            $dbData['scriptType'][] = $val;
                        }
                    }
                    LogHelper::error($name . " type  \n");
                }

                // 处理剧本编剧文件
                if ($file == 'writer' && $item == 'writer') {
                    $data = file_get_contents($fileDir . '/' . $name . '/' . $file);
                    $dataArr = explode("\n", $data);
                    foreach ($dataArr as $val) {
                        if (empty($val))
                            continue;

                        $dbData['writer'][] = $val;
                    }
                    LogHelper::error($name . " writer  \n");
                }

                if ($item == 'qrcode') {
                    $qrcode = $this->qrcode((string)$script['_id'], $name, $fileDir);
                    if ($qrcode != false) {
                        $dbData['qrcodeUrl'] = $qrcode;
                    }
                }

            }
            if (! empty($dbData))
                $modelDaoScript->modify(['_id' => $script['_id']], $dbData);
        }
    }



    /**
     * 格式化剧本文件
     *
     * @param $script
     */
    protected function formatScript($script)
    {
        $script = file_get_contents($script);
        $newArr = ['data' => []];
        $scriptArr = explode("\n", $script);

        foreach ($scriptArr as $key => $val) {
            if (preg_match("/^\d{1,3}、/", $val) == true || preg_match("/^\d{1,3}./", $val) == true) {
                $newArr["data"][] = [
                    "text" => $val,
                    "title" => 1,
                ];
            } else {
                $newArr["data"][] = [
                    "text" => $val,
                ];
            }
        }

        file_put_contents($script, json_encode($newArr, JSON_UNESCAPED_UNICODE));
    }

    protected function qrcode($scriptId, $name, $fileDir)
    {
        $modelLogicAccToken = new ModelLogicAccToken();
        $accToken = $modelLogicAccToken->accToken();

        $params = [
            'path' => 'pages/article/article?scene='.$scriptId,
        ];
        $qrcodeApi = Yii::app()->params['wechat_qrcodeApi'] . 'access_token=' . $accToken;

//            $postPar = json_encode($params);
        $header = ['content-type:application/json'];
        $qrcode = HttpHelper::request($qrcodeApi, $params, 10, 'POST', [], $header);
        if ($qrcode === false) {
            LogHelper::error($name . ' get qrcode failed, errmsg : ' . $qrcode);
            exit();
        }
        $qrcodeArr = @json_decode($qrcode, true);
        if (is_array($qrcodeArr)) {
            LogHelper::error($name . ' get qrcode failed, errmsg : ' . $qrcode['errmsg']);
            exit();
        }

        $qrcodeDir = $fileDir . '/' . $name . '/qrcode';
        file_put_contents($qrcodeDir, $qrcode);
        $etag = QiniuHelper::uploadFile($qrcodeDir);
        if ($etag === false) {
            LogHelper::error($name . ' upload qrcode failed');
            return false;
        }

        return $etag;
    }
}

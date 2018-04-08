<?php

class QrcodeCommand extends CConsoleCommand
{
    public function actionGet()
    {
        $modelLogicAccToken = new ModelLogicAccToken();
        $accToken = $modelLogicAccToken->accToken();

        $qrcodeApi = Yii::app()->params['wechat_qrcodeApi'] . 'access_token=' . $accToken;

        $modelDaoScript = new ModelDaoScript();
        $cur = $modelDaoScript->find();

        $qrcodeDir = '/home/worker/data/qrcode/';

        while ($cur->hasNext()) {
            $data = $cur->getNext();
            $scriptId = (string)$data['_id'];
            $name = $data['name'];
            $params = [
                'path' => 'pages/article/article?scene='.$scriptId,
            ];

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

            file_put_contents($qrcodeDir.$name, $qrcode);
            $etag = QiniuHelper::uploadFile($qrcodeDir.$name);
            if ($etag === false)
                LogHelper::error($name . ' upload qrcode failed');

            $modelDaoScript->modify(['_id' => $data['_id']], ['qrcodeUrl' => $etag]);

            LogHelper::error($name . ' success');

            exit();
        }


    }
}

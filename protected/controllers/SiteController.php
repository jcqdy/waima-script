<?php

class SiteController extends CController
{
    public function actionIndex()
    {
        echo '404';
    }

    public function actionError()
    {
        echo '出错了';
        die();
//        if ($error = Yii::app()->errorHandler->error) {
//            print_r($error);
//        }
    }

    public function actionKinesis()
    {
        /**
         * @var $data array
         */
        $data = explode(',', $_REQUEST['data']);
        foreach ($data as $k => $event) {
            $event = explode("\t", base64_decode($event));
            error_log(json_encode($event) . "\n", 3, '/tmp/kinesis.txt');
        }
        echo 'success';
    }
}

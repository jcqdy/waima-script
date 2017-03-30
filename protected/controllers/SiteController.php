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

    public function actionData()
    {
        $a = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"shareCount":146},"list":[{"id":773097468,"sceneId":79497552,"num":1,"name":null,"properties":{"thumbSrc":"group1/M00/AC/56/yq0KA1T_uOeAA7YEAASR_9TQBOU336.png"},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bbsl50n9159jmjq1f551v0d18v016.png?imageMogr2/auto-orient/crop/!937x1476a0a189","originSrc":"o_1bbsl50n9159jmjq1f551v0d18v016.png","cropSize":{"x":0,"y":49,"w":241.9047619047619,"h":381},"anim":[],"croptype":1},"type":3,"id":4160715823,"pageId":773097468,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":773447135,"sceneId":79497552,"num":2,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bc7df120ddu7gbmes1q4rre19.png?imageMogr2/auto-orient/crop/!937x1476a0a189","originSrc":"o_1bc7df120ddu7gbmes1q4rre19.png","cropSize":{"x":0,"y":49,"w":241.9047619047619,"h":381},"anim":[],"croptype":1},"type":3,"id":1906425031,"pageId":773447135,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":776064154,"sceneId":79497552,"num":3,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bbt9jo6t1ajok531bei1ud819v9.png?imageMogr2/auto-orient/crop/!938x1477a0a155","originSrc":"o_1bbt9jo6t1ajok531bei1ud819v9.png","cropSize":{"x":0,"y":40,"w":242,"h":381.15000000000003},"anim":[],"croptype":1},"type":3,"id":7256677250,"pageId":776064154,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":776519000,"sceneId":79497552,"num":4,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bc7ct547v8s69130apuhqm69.png?imageMogr2/auto-orient/crop/!937x1475a0a154","originSrc":"o_1bc7ct547v8s69130apuhqm69.png","cropSize":{"x":0,"y":40,"w":242,"h":381.15000000000003},"anim":[],"croptype":1},"type":3,"id":3898201801,"pageId":776519000,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":776063884,"sceneId":79497552,"num":5,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bc7d6dri19cqdpm1itaed13lt9.png?imageMogr2/auto-orient/crop/!938x1477a0a155","originSrc":"o_1bc7d6dri19cqdpm1itaed13lt9.png","cropSize":{"x":0,"y":40,"w":242,"h":381.15000000000003},"anim":[],"croptype":1},"type":3,"id":5360625877,"pageId":776063884,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":776520043,"sceneId":79497552,"num":6,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bc7curst18j137tpi110em1htd14.png?imageMogr2/auto-orient/crop/!938x1477a0a170","originSrc":"o_1bc7curst18j137tpi110em1htd14.png","cropSize":{"x":0,"y":44,"w":242,"h":381.15000000000003},"anim":[],"croptype":1},"type":3,"id":7996219662,"pageId":776520043,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":779366639,"sceneId":79497552,"num":7,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bc7cursth8ladk1ab618dn19f115.png?imageMogr2/auto-orient/crop/!937x1475a0a174","originSrc":"o_1bc7cursth8ladk1ab618dn19f115.png","cropSize":{"x":0,"y":45,"w":242,"h":381.15000000000003},"anim":[],"croptype":1},"type":3,"id":5613713024,"pageId":779366639,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null},{"id":781949268,"sceneId":79497552,"num":8,"name":null,"properties":{},"elements":[{"css":{"zIndex":1,"top":0,"left":0},"properties":{"imgSrc":"o_1bcekddrt1d4919r31s0c17t51muo9.png?imageMogr2/auto-orient/crop/!939x1478a0a190","originSrc":"o_1bcekddrt1d4919r31s0c17t51muo9.png","cropSize":{"x":0,"y":49,"w":241.9047619047619,"h":381},"anim":[],"croptype":1},"type":3,"id":2539318996,"pageId":781949268,"sceneId":79497552,"num":1,"name":"背景1"}],"scene":null,"price":null,"isPaid":null,"forms":null}]}';

        $b =  json_decode($a, true);
        echo json_encode($b);

    }
}

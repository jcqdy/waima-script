<?php
require_once(Yii::app()->basePath . '/components/qetag.php');

/**
 * @codeCoverageIgnore
 */
class AlbumQboxHelper extends Qbox6Helper
{

    const QBOX_RS_BUCKET = 'waima-script';
//  const QBOX_ACCESS_KEY = 'SLgWmV0UykhTyfY9UUdIHqlKjGeI68u9ksYjHh6x';
//  const QBOX_SECRET_KEY = 'F1bG2JKea9v624AzqVsneHZIoxJWQyMvRBUcVspk';
    const CALLBACK_PATH = '';
    const VIDEO_CALLBACK_PATH = '';
    const SHARE_VIDEO_CALLBACK_PATH = '';
    const EXPIRES = 3600;


    public static $osPattern = '/^([^\r\n\t\|]+\|){2,3}[^\r\n\t\|]+$/';
    public static $clientPattern = '/^[0-9a-zA-Z]+_[a-zA-Z]+_[0-9A-Za-z\.]+$/';
    public static $imageAvePattern = '/^\{"RGB":"0x[0-9A-Za-z]{6}"\}$/';

    /**
     * @param String $imageAve {"RGB":"0x213335"}
     * @return int
     */
    public static function getColorFromImageAve($imageAve)
    {
        $color = 0;
        if (! $imageAve) {
            return $color;
        }
        if (strpos($imageAve, '{"RGB":"0x') !== 0) {
            return $color;
        }
        if (0 === preg_match(AlbumQboxHelper::$imageAvePattern, $imageAve)) {
            return $color;
        }
        $imageAve = json_decode($imageAve, true);
        $color = intval(hexdec($imageAve['RGB']));
        return $color;
    }

    public static function snsPutAuth($callbackUrl, $type = 'image', $endUser = null)
    {
        global $QINIU_UP_HOST;
        $data = array('url' => $QINIU_UP_HOST);
        $data['token'] = self::getSnsPutToken($callbackUrl, $type, $endUser);
        return $data;
    }

    protected static function getSnsPutToken($callbackUrl, $type, $endUser)
    {
        Qiniu_setKeys(self::QBOX_ACCESS_KEY, self::QBOX_SECRET_KEY);
        //http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html
        $putPolicy = new Qiniu_RS_PutPolicy(self::QBOX_RS_BUCKET);

        $putPolicy->CallbackUrl = $callbackUrl;

        // 限定为“新增”语意
        // 如果设置为非0值，则无论scope设置为什么形式，仅能以新增模式上传文件。
        $putPolicy->InsertOnly = 1;
        // 唯一属主标识     
        // 特殊场景下非常有用，比如根据App-Client标识给图片或视频打水印。
        $putPolicy->EndUser = $endUser;
        // 上传请求授权的截止时间
        // UNIX时间戳，单位：秒。
        $putPolicy->Expires = AlbumQboxHelper::EXPIRES;//半小时

        // 限定上传文件的大小，单位：字节（Byte）
        // 超过限制的上传内容会被判为上传失败，返回413状态码。
        // 图片最大支持10MB的文件，视频支持20M
        if ($type == 'video') {
            $putPolicy->FsizeLimit = 1024 * 1024 * 100;
        } elseif ($type == 'image' || $type == 'direct') {
            $putPolicy->FsizeLimit = 1024 * 1024 * 12;
        } elseif ($type == 'comment') { // @20161118新加评论上传图片类型
            $putPolicy->FsizeLimit = 1024 * 1024 * 12;
        }

        // 开启MimeType侦测功能
        // 设为非0值，则忽略上传端传递的文件MimeType信息，使用七牛服务器侦测内容后的判断结果
        $putPolicy->DetectMime = 1;

        // 限定用户上传的文件类型
        // 指定本字段值，七牛服务器会侦测文件内容以判断MimeType，再用判断值跟指定值进行匹配，匹配成功则允许上传，匹配失败返回403状态码
        // $putPolicy->mimeLimit='image/jpeg;image/png;image/jpg;image/gif';

        // 上传成功后，七牛云向App-Server发送POST请求的数据


        $putPolicy->CallbackBody = self::getSnsCallbackBody($type);

        $upToken = $putPolicy->Token(null);
        return $upToken;
    }

    //上传成功后，七牛云向App-Server发送POST请求的数据
    //支持魔法变量和自定义变量。callbackBody 要求是合法的 url query string。
    //如：key=$(key)&hash=$(etag)&w=$(imageInfo.width)&h=$(imageInfo.height)。

    protected static function getSnsCallbackBody($type)
    {
        $common = 'imageAve=$(imageAve)&mimeType=$(mimeType)&size=$(fsize)&key=$(key)&etag=$(etag)&' // image meta
            . 'userId=$(x:userId)&userToken=$(x:userToken)&token=$(x:token)&taskId=$(x:taskId)&desc=$(x:desc)&tag=$(x:tag)&' // for auth
            . 'appName=$(x:appName)&appname=$(x:appname)&appversion=$(x:appversion)&appVersion=$(x:appVersion)&systemVersion=$(x:systemVersion)&' // common parameters
            . 'platform=$(x:platform)&device=$(x:device)&deviceId=$(x:deviceId)&locale=$(x:locale)&channel=$(x:channel)&cid=$(x:cid)&' // common parameters
            . 'latitude=$(x:latitude)&longitude=$(x:longitude)&cameraModel=$(x:cameraModel)&width=$(x:width)&height=$(x:height)&';

        if ($type == 'comment') { // 评论图片
            return $common . 'exif=$(x:exif)&uid=$(x:uid)&sig=$(x:sig)&ip=$(x:ip)&type=$(x:type)&'
            . 'poi=$(x:poi)&c360=$(x:c360)';
        } else {
            return $common . 'exif=$(x:exif)&uid=$(x:uid)&sig=$(x:sig)&ip=$(x:ip)&duration=$(x:duration)&type=$(x:type)&stickerId=$(x:stickerId)&workMem=$(x:workMem)&'
            . 'atUsers=$(x:atUsers)&poi=$(x:poi)&workType=$(x:workType)&c360=$(x:c360)';
        }
    }

    /**
     *C('accessKey')取得 AccessKey
     *C('secretKey')取得 SecretKey
     *callback.php 为回调地址的Path部分
     *file_get_contents('php://input')获取RequestBody,其值形如:
     *name=sunflower.jpg&hash=Fn6qeQi4VDLQ347NiRm-RlQx_4O2\
     *&location=Shanghai&price=1500.00&uid=123
     *http://developer.qiniu.com/docs/v6/api/overview/up/response/callback.html
     */
    public static function isQiniuCallback($callback)
    {
        LogHelper::trace("七牛server：" . json_encode($_SERVER));
        if (! isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return false;
        }
        if (isset($_SERVER['HTTP_X_TEST']) && 'true' == $_SERVER['HTTP_X_TEST']) {
            return true;
        }
        $authstr = $_SERVER['HTTP_AUTHORIZATION'];
        if (strpos($authstr, "QBox ") != 0) {
            return false;
        }
        $auth = explode(":", substr($authstr, 5));
        if (sizeof($auth) != 2 || $auth[0] != self::QBOX_ACCESS_KEY) {
            return false;
        }
        //$data = "/callback.php\n".file_get_contents('php://input');
        $data = $callback . "\n" . file_get_contents('php://input');
//      LogHelper::info("七牛data：".print_r($data,true));
//      LogHelper::info("七牛原始的签名：".$authstr);
//      LogHelper::info("七牛计算后的签名：".self::urlsafe_base64_encode(hash_hmac('sha1',$data,self::QBOX_SECRET_KEY, true)));
//      LogHelper::info("七牛auth1：".$auth[1]);

        return self::urlsafe_base64_encode(hash_hmac('sha1', $data, self::QBOX_SECRET_KEY, true)) == $auth[1];
    }
}

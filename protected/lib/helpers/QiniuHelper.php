<?php
require_once(Yii::app()->basePath . '/lib/qbox7/autoload.php');
require_once(Yii::app()->basePath . '/components/qetag.php');
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


/**
 * 七牛helper
 *
 * Class QiniuHelper
 */
class QiniuHelper
{
    /**
     * 上传照片到七牛
     *
     * @param $image 照片的base64数据
     * @return array|bool 上传成返回etag,失败返回false
     */
    public static function uploadPic($image)
    {
        $id = uniqid();
        $tempPath = Yii::app()->params['tempImage'];
        if (! is_dir($tempPath)) {
            mkdir($tempPath);
        }
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $image, $result)) {
            $type = $result[2];
            $tempName = $id . '.' . $type;
            file_put_contents($tempPath . $tempName, base64_decode(str_replace($result[1], '', $image)));
        } else {
            return false;
        }

        $etag = GetEtag($tempPath . $tempName);
        $etag = $etag['0'];
        rename($tempPath . $tempName, $tempPath . $etag);

        $bucket = AlbumQboxHelper::QBOX_RS_BUCKET;
        $ret = QboxHelper::upload($tempPath . $etag, $bucket, $etag);

        unlink($tempPath . $etag);
        if ($ret !== true) {
            return false;
        } else {
            return $etag;
        }
    }

    /**
     * get pic info
     *
     * @param string $etag
     * @return array
     */
    public static function getQnPicInfo($etag, $model = "?imageInfo")
    {
        $host = Yii::app()->params['picHost'];
        $picUrl = $host . $etag . $model;

        $jsonRet = HttpHelper::get($picUrl, 3);
        return json_decode($jsonRet, true);
    }

    /**
     * 上传文件到七牛
     * @param string $file 图片地址
     * @param string $key 上传后存储在bucket中的名字
     */
    public static function uploadFile($file, $key)
    {
//        $ret = QboxHelper::upload($file, AlbumQboxHelper::QBOX_RS_BUCKET, $key);
//
//        if ($ret === true) {
//            return $key;
//        } else {
//            return false;
//        }

        $auth = new Auth(AlbumQboxHelper::QBOX_ACCESS_KEY,
            AlbumQboxHelper::QBOX_SECRET_KEY
        );

        $token = $auth->uploadToken(AlbumQboxHelper::QBOX_RS_BUCKET);
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
        if ($err !== null) {
            return false;
        } else {
            return $key;
        }
    }
}

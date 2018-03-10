<?php
class AlbumConfigHelper
{
    public static $ADMIN=false;
    public static $locale='zh_CN';
    
    public static function getSnsAlbumDB()
    {
        return Yii::app()->params['sns_album_db'];
    }
    
    public static function getSnsAlbumTesing()
    {
        return Yii::app()->params['sns_album_tesing'];
    }
    
    public static function getDefaultCover()
    {
        return Yii::app()->params['default_cover'];
    }
    
    public static function getDefaultPhoto()
    {
        return Yii::app()->params['default_photo'];
    }
    
    public static function getDefaultMemberLastestPhoto()
    {
        return Yii::app()->params['default_member_lastest_photo'];
    }
    
    public static function getQboxCallbackHost()
    {
        return Yii::app()->params['qboxCallbackHost'];
    }
    
    public static function getDatabaseConnConfig($clazz)
    {
        //TODO add conn config
        $config = array(
            'AlbumCounterModel' => 'album_counter',
            'AlbumFollowerModel' => 'album_follower',
            'AlbumMemberModel' => 'album_member',
            'AlbumModel' => 'album',
            'AlbumPhotoModel' => 'album_photo',
            'PhotoModel' => 'photo',
            'PhotoExifModel' => 'photo_exif',
            'DiscoveryModel' => 'discovery',
            'HotModel' => 'hot',
        );
        if (isset($config[$clazz])) {
            return $config[$clazz];
        }
        throw new AlbumException("unknow database configration name $clazz");
    }
    
    public static function getPgCacheConfig($clazz)
    {
        $config = array(
            'AlbumFollowerModel' => 'cache.follow',
            'AlbumMemberModel' => 'cache.member',
            'AlbumModel' => 'cache.album',
            'AlbumPhotoModel' => 'cache.photo',
            'PhotoModel' => 'cache.etag',
            'DiscoveryModel' => 'cache.discovery',
            'HotModel' => 'cache.hot',
        );
        if (isset($config[$clazz])) {
            return $config[$clazz];
        }
        throw new AlbumException("unknow pgcache configration name $clazz");
    }
}

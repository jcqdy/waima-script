<?php

class ModelLogicLogin
{
    public function openId($code)
    {
        $weChatApi = Yii::app()->params['wechat_sessionKeyApi'];

        $param = http_build_query([
            'appid' => Yii::app()->params['appId'],
            'secret' => Yii::app()->params['appSecret'],
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ]);
        
        $ret = Http::get($weChatApi . $param);
        $ret = @json_decode($ret, true);
        if (! isset($ret['openid']))
            throw new Exception('get openId failed', Errno::FATAL);

        
    }
}

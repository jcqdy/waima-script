<?php

class Http extends HttpHelper
{
    public static function post($url, $params = array(), $timeout = 10, $options = array(), &$header = null)
    {
        $arrUrl = parse_url($url);
        $profile_name = (isset($arrUrl['host'])?strval($arrUrl['host']):'') . (isset($arrUrl['path'])?strval($arrUrl['path']):'');
        LogHelper::profile_start($profile_name);
    
        $ch = curl_init();
        // forward logid
        if (isset($_SERVER['LOG_ID']) && is_string($_SERVER['LOG_ID']) && ! empty($_SERVER['LOG_ID'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Ngx-LogId: ' . strval($_SERVER['LOG_ID'])));
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        if (isset($header)) {
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'self::headerCallBack');
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, $options);
        $return = curl_exec($ch);
        LogHelper::profile_end($profile_name);
        if (curl_errno($ch)) {
            self::$lastError=curl_errno($ch);
            Yii::log('post request failed. url-'.$url.' params-'.var_export($params, true).' errno-'.curl_errno($ch).' error-'.curl_error($ch), CLogger::LEVEL_ERROR);
            return false;
        }
        if (isset($header)) {
            $header = self::$header;
        }
        curl_close($ch);
        return $return;
    }
}

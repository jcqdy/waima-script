<?php
class ModelLogicAccToken
{
    /**
     * 获取AccessToken
     *
     * @return mixed
     * @throws Exception
     */
    public function accToken()
    {
        $modelDaoAccToken = new ModelDaoAccToken();
        $data = $modelDaoAccToken->getOne();
        $time = time();
        if (! empty($data)) {
            if ($data['expireTime'] > $time && $data['expireTime'] - $time > 60) {
                $accToken = $data['accToken'];
            } else {
                list($accToken, $expireLimit) = $this->getToken();
                $expireTime = $time + $expireLimit;
                $modelDaoAccToken->updateToken($data['_id'], $accToken, $expireLimit, $expireTime);
            }
        } else {
            list($accToken, $expireLimit) = $this->getToken();
            $expireTime = $time + $expireLimit;
            $modelDaoAccToken->addToken($accToken, $expireLimit, $expireTime);
        }

        return $accToken;
    }

    public function sig($url)
    {
        $ticket = $this->ticket();
        $noncestr = $this->getRandChar(16);
        $time = time();

        $arr = [
            'noncestr' => $noncestr,
            'jsapi_ticket' => $ticket,
            'timestamp' => $time,
            'url' => $url,
        ];
        $str = http_build_query($arr);
        $sig = sha1($str);

        $arr['appId'] = Yii::app()->params['wechat']['appId'];
        $arr['signature'] = $sig;

        return $arr;
    }

    /**
     * 获取微信ticket
     *
     * @return bool|mixed|string
     * @throws Exception
     */
    public function ticket()
    {
        $modelDaoTicket = new ModelDaoTicket();
        $data = $modelDaoTicket->getOne();
        $time = time();
        if (! empty($data)) {
            if ($data['expireTime'] > $time && $data['expireTime'] - $time > 60) {
                $ticket = $data['ticket'];
            } else {
                $accToken = $this->accToken();
                $ticket = $this->getTicket($accToken);
            }
        } else {
            $accToken = $this->accToken();
            $ticket = $this->getTicket($accToken);
        }

        return $ticket;
    }

    /**
     * 从微信刷新token
     *
     * @return array
     * @throws Exception
     */
    protected function getToken()
    {
        $weChatConf = Yii::app()->params['wechat'];
        $param = [
            'grant_type' => 'client_credential',
            'appid' => $weChatConf['appId'],
            'secret' => $weChatConf['appSecret'],
        ];
        $wechatUrl = $weChatConf['getAccTokenUrl'] . '?' . http_build_query($param);

        $ret = HttpHelper::get($wechatUrl);

        if (! $ret) {
            throw new Exception('get wechat accessToken failed', Errno::INTERNAL_SERVER_ERROR);
        }

        $ret = json_decode($ret, true);
        return array_values($ret);
    }

    /**
     * 从微信刷新ticket
     *
     * @param $accToken
     * @return bool|mixed|string
     * @throws Exception
     */
    protected function getTicket($accToken)
    {
        $weChatConf = Yii::app()->params['wechat'];
        $param = [
            'access_token' => $accToken,
            'type' => 'jsapi',
        ];
        $wechatUrl = $weChatConf['getTicketUrl'] . '?' . http_build_query($param);

        $ret = HttpHelper::get($wechatUrl);

        if (! $ret) {
            throw new Exception('get wechat ticket failed', Errno::INTERNAL_SERVER_ERROR);
        }

        $ret = json_decode($ret, true);
        if ($ret['errcode'] != 0) {
            throw new Exception('get wechat ticket failed, errcode : ' . $ret['errcode'] . ' errmsg : ' . $ret['errmsg'], Errno::INTERNAL_SERVER_ERROR);
        }

        return $ret;
    }

    /**
     * 生成随机字符串
     *
     * @param $length
     * @return null|string
     */
    protected function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
}
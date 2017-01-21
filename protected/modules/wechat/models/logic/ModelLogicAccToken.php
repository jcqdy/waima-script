<?php
class ModelLogicAccToken
{
    protected $wechatConf;

    public function __construct()
    {
        $this->wechatConf = Yii::app()->params['wechat'];
    }

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

    /**
     * 获取微信ticket
     *
     * @return bool|mixed|string
     * @throws Exception
     */
    public function ticketData($url)
    {
        $modelDaoTicket = new ModelDaoTicket();
        $data = $modelDaoTicket->findByUrl($url);
        $time = time();
        if (! empty($data)) {
            if ($data['expireTime'] > $time && $data['expireTime'] - $time > 60) {
                $ticketData = [
                    'nonceStr' => $data['noncestr'],
                    'jsapi_ticket' => $data['ticket'],
                    'timestamp' => $data['timestamp'],
                    'url' => $data['url'],
                    'appId' => $this->wechatConf['appId'],
                    'signature' => $data['signature'],
                ];
            } else {
                $accToken = $this->accToken();
                $ret = $this->getTicket($accToken);
                $ticket = $ret['ticket'];
                $expiresLimit = $ret['expires_in'];
                $expireTime = $time + $expiresLimit;

                $sigData = $this->countSig($ticket, $url);
                $modelDaoTicket->updateTicket($data['_id'], $ticket, $expiresLimit, $expireTime, $sigData['noncestr'], $sigData['timestamp'], $url, $sigData['signature']);

                $ticketData = [
                    'nonceStr' => $sigData['noncestr'],
                    'jsapi_ticket' => $ticket,
                    'timestamp' => $sigData['timestamp'],
                    'url' => $url,
                    'appId' => $this->wechatConf['appId'],
                    'signature' => $sigData['signature'],
                ];
            }
        } else {
            $accToken = $this->accToken();
            $ret = $this->getTicket($accToken);
            $ticket = $ret['ticket'];
            $expiresLimit = $ret['expires_in'];
            $expireTime = $time + $expiresLimit;

            $sigData = $this->countSig($ticket, $url);
            $modelDaoTicket->addTicket($ticket, $expiresLimit, $expireTime, $sigData['noncestr'], $sigData['timestamp'], $url, $sigData['signature']);

            $ticketData = [
                'nonceStr' => $sigData['noncestr'],
                'jsapi_ticket' => $ticket,
                'timestamp' => $sigData['timestamp'],
                'url' => $url,
                'appId' => $this->wechatConf['appId'],
                'signature' => $sigData['signature'],
            ];
        }

        return $ticketData;
    }

    /**
     * 计算sig
     *
     * @param $ticket
     * @param $url
     * @return array
     */
    protected function countSig($ticket, $url)
    {
        $noncestr = $this->getRandChar(16);
        $time = time();

        $arr = [
            'jsapi_ticket' => $ticket,
            'noncestr' => $noncestr,
            'timestamp' => $time,
            'url' => $url,
        ];
        $str = 'jsapi_ticket='.$ticket.'&noncestr='.$noncestr.'&timestamp='.$time.'&url='.urldecode($url);
        $sig = sha1($str);

        $arr['signature'] = $sig;

        return $arr;
    }



    /**
     * 从微信刷新token
     *
     * @return array
     * @throws Exception
     */
    protected function getToken()
    {
        $param = [
            'grant_type' => 'client_credential',
            'appid' => $this->wechatConf['appId'],
            'secret' => $this->wechatConf['appSecret'],
        ];
        $wechatUrl = $this->wechatConf['getAccTokenUrl'] . '?' . http_build_query($param);

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
        $param = [
            'access_token' => $accToken,
            'type' => 'jsapi',
        ];
        $wechatUrl = $this->wechatConf['getTicketUrl'] . '?' . http_build_query($param);

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
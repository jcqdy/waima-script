<?php
class ModelLogicAccToken
{
    public function execute()
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
}
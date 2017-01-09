<?php

class AccessCheckFilter extends CAccessControlFilter
{

    protected $_innerApiCall = false;
    protected $needUserIdAndToken = false;

    /**
     * 设置标识，表明是内部接口调用
     *
     * @access public
     * @return void
     */
    public function setIsInner()
    {
        $this->_innerApiCall = true;
    }

    /**
     * hook preFilter
     *
     * @param mixed $filterChain
     * @access protected
     * @return bool
     */
    protected function preFilter($filterChain)
    {
        if ($this->_innerApiCall == false) {
            $aryInfo = $this->publicLogin();
        } else {
            $aryInfo = $this->innerLogin();
        }
        if (is_array($aryInfo) == true) {
            $aryUser = array(
                'id' => $aryInfo['userId'],
                'name' => $aryInfo['nickname']
            );
            foreach ($aryUser as $key => $value) {
                Yii::app()->user->$key = $value; // 没有设置user组件情况下，如果在各自的controller中设置了eg：array('allow', 'actions' => array('index'))，则不会报420错误。
            }
        }

        return parent::preFilter($filterChain);
    }

    /**
     * 外部接口登录
     *
     * @access public
     * @return array | boolean
     */
    public function publicLogin()
    {
        $request = $_REQUEST;
        $userId = ParameterValidatorHelper::validateMongoIdAsString($request, 'userId', null);
        $token = ParameterValidatorHelper::validateString($request, 'token', null, null, '');
        if (! $token) {
            $token = ParameterValidatorHelper::validateString($request, 'userToken', null, null, '');
        }

        if (! $userId || ! $token) {
            $this->needUserIdAndToken = true;
            return false;
        }
        
        try {
            $userInfo = new UserInfoHelper();
            // H5 没有token
            $uInfo = $userInfo->getUserInfo($userId, $token);
            if (!is_array($uInfo)) {
                return false;
            }
            if ($uInfo['userId'] instanceof MongoId) {
                $uInfo['userId'] = strval($uInfo['userId']);
            }
            return $uInfo;
        } catch (Exception $e) {
        }

        return false;
    }

    /**
     * 内部登录.
     *
     * @access public
     * @return array
     */
    public function innerLogin()
    {
        $userId = Yii::app()->request->getParam('userId');
        if ($userId == null) {
            return false;
        }
        $aryUsers = SsoUserHelper::multiInfo(array($userId));
        if ($aryUsers == false || count($aryUsers) == 0) {
            return false;
        }

        return current($aryUsers);
    }

    public function accessDenied($user, $message)
    {
        $data = new stdClass();
        if ($user->isGuest == true) {
            if ($this->needUserIdAndToken) {
                ResponseHelper::outputJsonV2($data, 'UserId and Token is required', Errno::PARAMETER_VALIDATION_FAILED);
            }
            ResponseHelper::outputJsonV2($data, Yii::t('errorno', Errno::USER_LOGIN_REQUIRED, null, null, LanguageHelper::getLanguage($_REQUEST['locale'])), Errno::USER_LOGIN_REQUIRED);
        } else {
            // @todo: 还未想清楚, 由于不用于更高的权限检查,暂时用不到
            ResponseHelper::outputJsonV2($data, Yii::t('errorno', Errno::USER_LOGIN_REQUIRED, null, null, LanguageHelper::getLanguage($_REQUEST['locale'])), Errno::USER_LOGIN_REQUIRED);
        }
    }
}

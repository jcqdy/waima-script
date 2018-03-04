<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    protected $userId = null;
    protected $sig = null;
    protected $appVersion = null;
    protected $platform = null;

    protected $uripath = '';

    public function init()
    {
        parent::init();

        // 增加Ajax标识，用于异常处理
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) == false) {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        }

        if (!defined('MODULE_NAME')) {
            define('MODULE_NAME', 'photoTask');
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $arrUrl = parse_url('http://www.example.com' . strval($_SERVER['REQUEST_URI']));
            $this->uripath = strval($arrUrl['path']);
        }

        LogHelper::init();
        // 打印请求参数
        $arrLogParams = $_REQUEST;
        if (isset($arrLogParams['token'])) {
            // $arrLogParams['token'] = '***<' . strlen($arrLogParams['token']) . 'chars>';
        }
        if (isset($arrLogParams['userToken'])) {
            $arrLogParams['userToken'] = '***<' . strlen($arrLogParams['userToken']) . 'chars>';
        }
        LogHelper::pushLog('params', $arrLogParams);
    }

    public function filters()
    {
        return array(
            'checkCommonParameters',
            'verifySign',
            'accessControl',
        );
    }

    /**
     * 检验公共参数.
     *
     * @param mixed $filterChain
     * @access public
     * @return void
     */
    public function filterCheckCommonParameters($filterChain)
    {
        $aryCommParams = ControllerParameterValidator::validateCommonParamters($_REQUEST);

        $this->userId = $aryCommParams['userId'];
        $this->appVersion = $aryCommParams['appVersion'];
        $this->platform = $aryCommParams['platform'];

        $filterChain->run();
    }

    public function filterAccessControl($filterChain)
    {
        $filter = new AccessCheckFilter();
        $filter->setRules($this->accessRules());
        $filter->filter($filterChain);
    }

    public function filterH5Control($filterChain)
    {
        $filter = new H5AccessCheckFilter();
        $filter->setRules($this->accessRules());
        $filter->filter($filterChain);
    }

    /**
     * 检验签名
     * @return bool
     * @throws ErrorException
     * @throws Exception
     */
    public function filterVerifySign($filterChain)
    {
        // 开发环境不对sig进行验证.
        if (defined('APPLICATION_ENV') && (APPLICATION_ENV == 'newdev' || APPLICATION_ENV == 'development')) {
            $filterChain->run();
            return;
        }
        // qa、test环境万能签名.
        if (defined('APPLICATION_ENV') && (APPLICATION_ENV == 'testing' || APPLICATION_ENV == 'testing_dev')) {
            $sig = ParameterValidatorHelper::validateString($_REQUEST, 'sig');
            if ($sig == '56610f9fce1cdd07098cd80d') {
                $filterChain->run();
                return;
            }
        }


        // 验证sig
        $sig = ParameterValidatorHelper::validateString($_POST, 'sig');
        $secretKey = Yii::app()->params['appSecret'];

        $allParams = array_merge($_POST, $_GET);
        unset($allParams['sig']);

        $sign = SecurityHelper::sign($allParams, $secretKey);

        if (strcmp($sig, $sign) !== 0) {
            //all urlencode
            foreach ($allParams as $k => $v) {
                $allParams[$k] = urlencode($v);
            }
            $sign = SecurityHelper::sign($allParams, $secretKey);
            if (strcmp($sign, $sig) !== 0) {
                // LogHelper::warning('Sig failed with request: ' . json_encode($_REQUEST));
                LogHelper::trace('Sig failed with request: ' . json_encode($_REQUEST));
                throw new Exception('invalid sign', Errno::SIG_ERROR);
            }
        }
        $filterChain->run();
    }

    /**
     * 禁言检查
     * @return bool
     * @throws ErrorException
     * @throws ParameterValidationExpandException
     */
    public function filterBanPost($filterChain)
    {
        $request = $_REQUEST;
        $userId = ParameterValidatorHelper::validateMongoIdAsString($request, 'userId', null);
        if ($userId == null) {
            $filterChain->run();
            return true;
        }

        $mlb = Factory::create('ModelLogicBan');

        $res = $mlb->getByUid($userId, false);

        if (is_array($res) && in_array($res['status'], array(1, 2))) {
            throw new ErrorException(Yii::t('errorno', Errno::FORBIDDEN), Errno::FORBIDDEN);
        }

        $token = ParameterValidatorHelper::validateString($request, 'token');
        $this->checkUserToken($userId, $token);

        $filterChain->run();
    }

    /**
     * 禁言检查
     * @return bool
     * @throws ErrorException
     * @throws ParameterValidationExpandException
     */
    public function checkbanPost($userId = '')
    {
        if ($userId == '') {
            return true;
        }

        $mlb = Factory::create('ModelLogicBan');
        $res = $mlb->getByUid($userId, false);

        if (is_array($res) && in_array($res['status'], array(1, 2))) {
            throw new ErrorException(Yii::t('errorno', Errno::FORBIDDEN), Errno::FORBIDDEN);
        }

        $token = ParameterValidatorHelper::validateString($_REQUEST, 'token');
        $this->checkUserToken($userId, $token);

        return true;
    }

    /**
     * 检查用户token
     * @param $userId
     * @param $token
     * @return bool
     * @throws ErrorException
     */
    public function checkUserToken($userId, $token)
    {
        if (empty($userId) || empty($token)) {
            throw new ErrorException(Yii::t('errorno', Errno::USER_LOGIN_REQUIRED), Errno::USER_LOGIN_REQUIRED);
        }

        try {
            // 不等于200会在Curl层面抛出异常
            SsoUserHelper::checkToken($userId, $token);
        } catch (Exception $e) {
            if ($e->getCode() != 500) {
                throw new ErrorException(Yii::t('errorno', Errno::USER_LOGIN_REQUIRED), Errno::USER_LOGIN_REQUIRED);
            }
        }

        return true;
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users' => array('@')
            ),
            array('deny')
        );
    }

    public function run($actionID)
    {
        try {
            parent::run($actionID);
        } catch (ParameterValidationException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . Errno::PARAMETER_VALIDATION_FAILED);
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), Errno::PARAMETER_VALIDATION_FAILED);
        } catch (PrivilegeException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . Errno::PRIVILEGE_NOT_PASS);
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), Errno::PRIVILEGE_NOT_PASS);
        } catch (MongoException $e) {
            LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
            ResponseHelper::outputJsonV2(array(), '网络不给力', Errno::FATAL);
        } catch (Exception $e) {
            if ($e->getCode() == Errno::PIC_NOT_EXIST) {
                //作品不存在只记录warning
                LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            } elseif ($e->getCode() != Errno::SIG_ERROR && $e->getCode() != Errno::ANTI_SPAM_UNPASS) {
                // 签名错误，鉴黄不通过，情况下不写错误日志
                LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
            }
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        }
    }

    protected function beforeAction($action)
    {
        LogHelper::pushLog('nickname', Yii::app()->user->getName());

        return true;
    }

    /**
     * 默认报错
     */
    public function defaultData()
    {
        ResponseHelper::outputJsonV2(array(), 'system busy, please try later.', 500);
    }
}

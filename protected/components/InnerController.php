<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class InnerController extends CController
{
    public function init() 
    {
        parent::init();

        // 增加Ajax标识，用于异常处理
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) == false) {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        }

        !defined('MODULE_NAME') && define('MODULE_NAME', SYSTEM_NAME);
        if (isset($_REQUEST['__appVersion'])) {
            !defined('APP_VERSION') && define('APP_VERSION', $_REQUEST['__appVersion']);
        }
        if (isset($_REQUEST['__locale'])) {
            !defined('LOCALE') && define('LOCALE', $_REQUEST['__locale']);
        }
        !defined('INNER') && define('INNER', true);
        LogHelper::init();
        LogHelper::pushLog('params', $_REQUEST);
    }

    /**
     * Runs the named action.
     * Filters specified via {@link filters()} will be applied.
     * @param string $actionID action ID
     * @throws CHttpException if the action does not exist or the action name is not proper.
     * @see filters
     * @see createAction
     * @see runAction
     */
    public function run($actionID)
    {
        try {
            parent::run($actionID);
        } catch (ParameterValidationException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            LogHelper::warning(@json_encode(debug_backtrace()));
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            if ($e->getCode() == Errno::PIC_NOT_EXIST) {
                //作品不存在只记录warning
                LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            } elseif ($e->getCode() != Errno::SIG_ERROR && $e->getCode() != Errno::ANTI_SPAM_UNPASS) {
                // 签名错误，鉴黄不通过，情况下不写错误日志
                LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
                LogHelper::error(@json_encode(debug_backtrace()));
            }
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        }
    }
}

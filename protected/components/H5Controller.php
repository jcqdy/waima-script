<?php

/**
 * H5Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class H5Controller extends CController
{
    public $layout = 'main';
    public $nologin = array();  // 不需要登录
    protected $requestAjax = false; // 请求类型
    protected $uripath = '';

    public function init()
    {
        parent::init();

        // 增加Ajax标识，用于异常处理
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->requestAjax = true;
        }

        if (! defined('MODULE_NAME')) {
            define('MODULE_NAME', 'photoTask');
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $arrUrl = parse_url('http://www.example.com' . strval($_SERVER['REQUEST_URI']));
            $this->uripath = strval($arrUrl['path']);
        }

        LogHelper::init();
        // 打印请求参数
        $arrLogParams = $_REQUEST;
        LogHelper::pushLog('params', $arrLogParams);
    }

    public function filters()
    {
        return array();
    }

    public function run($actionID)
    {
        try {
            parent::run($actionID);
        } catch (CHttpException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            if ($this->requestAjax) {
                ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
            } else {
                throw $e;
            }
        } catch (ParameterValidationException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            //$this->requestAjax && ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        } catch (ParameterValidationExpandException $e) {
            LogHelper::warning($e->getMessage() . ' with code ' . $e->getCode());
            //$this->requestAjax && ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            LogHelper::error($e->getMessage() . ' with code ' . $e->getCode());
            //$this->requestAjax && ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
            ResponseHelper::outputJsonV2(array(), $e->getMessage(), $e->getCode());
        }
    }

    protected function beforeAction($action)
    {
        return true;
    }

    public function render($view, $data = null, $return = false)
    {
        parent::render($view, $data, $return);
        LogHelper::pushLog('status', 200);
    }
}

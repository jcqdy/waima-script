<?php
! defined('SYSTEM_NAME') && define('SYSTEM_NAME', 'waima-op');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
! defined('WWW_DIR') && define('WWW_DIR', realpath(dirname(__FILE__) . '/../../..'));
! defined('LIB_DIR') && define('LIB_DIR', WWW_DIR . '/lib');
! defined('VAR_DIR') && define('VAR_DIR', WWW_DIR . '/../var/' . SYSTEM_NAME);    // 存储程序运行所需数据
! defined('RUNTIME_DIR') && define('RUNTIME_DIR', WWW_DIR . '/runtime/' . SYSTEM_NAME);
! is_dir(RUNTIME_DIR) && @mkdir(RUNTIME_DIR, 0755, true);
set_include_path(get_include_path() . ':' . LIB_DIR);
YiiBase::setPathOfAlias('yii-ext', LIB_DIR . '/yii-ext');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => SYSTEM_NAME,
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.components.*',
        'application.components.filters.*',
        'application.components.dto.*',
        'application.lib.*',
        'yii-ext.helpers.*',
        'application.lib.helpers.*',
        'yii-ext.vendors.*',
        'yii-ext.components.*',
        'yii-ext.components.cache.*',
        'yii-ext.models.*',
        'yii-ext.models.data.*',
        'yii-ext.models.logic.*',
    ),
    'runtimePath' => constant('RUNTIME_DIR'),
    'modules' => array(
        'reward' => array(), // module setting
    ),
    // application components
    'components' => array(
        'messages' => array(
            'forceTranslation' => true,   // 当翻译语言为en_us,若取消此字段，会导致无法得到正确消息.@see CMessageSource.php line 84
        ),
        'user' => array(
            // enable cookie-based authentication
            //'allowAutoLogin'=>true,
            'class' => 'WebUser',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                //pic模块合并到task模块
                'pic/<action:\w+>' => 'task/<action>',
                'pic/inner/<action:\w+>' => 'task/inner/<action>',
            ),
        ),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                'file' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error,warning',
                    'maxFileSize' => 2 * 1024 * 1024,
                    'maxLogFiles' => 100,
                ),
                'notice' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'notice,trace,info',
                    'logFile' => 'notice.log',
                    'maxFileSize' => 2 * 1024 * 1024,
                    'maxLogFiles' => 100,
                ),
                'recommend' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'recommend.*',
                    'logFile' => 'recommend.log',
                    'maxFileSize' => 2 * 1024 * 1024,
                    'maxLogFiles' => 100,
                ),
                'profile' => array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'logFile' => 'profile.log',
                    'maxFileSize' => 100 * 1024,
                    'maxLogFiles' => 100,
                ),
            ),
        ),
    ),
    'params' => array(),
);

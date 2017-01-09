<?php

/**
 * 没权限的异常
 */
class PrivilegeException extends ErrorException
{

    public function __construct($message, $code = Errno::PRIVILEGE_NOT_PASS)
    {
        parent::__construct($message, $code);
    }
}

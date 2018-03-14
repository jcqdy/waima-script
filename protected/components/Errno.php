<?php

class Errno
{
    const USER_LOGIN_REQUIRED           = 420;      // 需要登录
    const PARAMETER_VALIDATION_FAILED   = 401;      // 缺少必要参数
    const PRIVILEGE_NOT_PASS            = 403;      //
    const INTERNAL_SERVER_ERROR         = 500;      // 内部错误
    const FATAL                         = 500;      // 服务器异常
    // ... other error

    const INVALID_PARAMETER             = 11360;    // 参数错误
    const RESPONSE_WRONG                = 11361;    // 响应错误
    const SIG_ERROR                     = 11362;    // 签名错误
    const MEMBER_ERROR                  = 11363;    // 提交到会员系统错误
    const JSON_ERROR                    = 11045;    // json格式错误
    const AWARD_ERROR                   = 11020;    // 领奖错误
    const NO_AWARD                      = 11021;    // 该用户并未中奖

    const ACTIVE_OFF_LINE               = 12000;    // 活动已经下线
}

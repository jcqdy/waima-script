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

    const QBOX_CALLBACK_ILLEGALITY      = 12001;    // qbox回调地址错误

    const PIC_NOT_EXIST                 = 11001;    // 作品不存在
    const REC_NOT_EXIST                 = 11002;    // 编辑精选不存在
    const USER_NOT_EXIST                = 11003;    // 用户不存在

    const ANTI_SPAM_UNPASS              = 19001;    // 反垃圾未通过

    const FORBIDDEN                     = 11403;    // 禁言
    
    const CANCEL_TOP                    = 11502;    // 要先取消置顶

    const EXPERT_EXIST                  = 16001;    // 已经是达人
    const EXPERT_APPLY                  = 16002;    // 申请正在审核
    const EXPERT_NOT_EXIST              = 16003;    // 申请不存在
    const EXPERT_UNABLE                 = 16004;    // 不满足申请条件

    const COMMENT_NOT_FOUND             = 18003;    // 评论未找到

    const TRANSLATION_FAILED            = 20001;    // 翻译失败

    const EMOTICON_NOT_FOUND            = 21001;    // 动态表情不存在

    const TASK_INTERFACE_ERROR          = 1003;     //task模块接口异常
}

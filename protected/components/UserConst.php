<?php

/**
 * 用户模块const.
 * Author: hewenlong
 * Date: 2015/12/11
 * Time: 16:02
 */

class UserConst
{
    const EXPIRE_TIME = 172800;

    const SCORE_KEYS  = 'userScore_';
    
    const NO_COMPARE_RELATION = -1;  // 没有比较关系
    
    const NO_RELATION = 0;           // 没有关系

    const FOLLOW_RELATION = 1;       // 关注关系

    const FANS_RELATION = 2;         // 粉丝关系

    const EACH_FOLLOW_RELATION = 3;  // 互粉关系

    const SELF_RELAION = 4;          // 自身关系

    const MAX_FOLLOWS_NUM = 2000;   //最大关注数
}

<?php
/**
 * feed模块常量
 * 
 * @uses      FeedConst
 * @version   2016年4月1日
 * @author    lilin <lilin@camera360.com>
 * @copyright Copyright 2010-2016 成都品果科技有限公司 
 * @license PHP Version 5.x {@link http://www.php.net/license/3_0.txt}
 */
class FeedConst
{
    /* 动态类型 */
    const FEED_PHOTO = "photo";                 // 图片动态
    const FEED_VIDEO = "video";                 // 视频动态
    const FEED_FOLLOW_AND_LIKE = "followLike";  // 用户关注和点赞动态 
    const FEED_LATEST_TASK = "latestTask";      // 最近挑战动态 
    const FEED_NO_FOLLOW_REC_USERS = "recUser";      
    
    const FEED_LIST_SHIELD_TIME = 5;            // 动态列表5秒内设置保护机制
    const FEED_PAGE_SIZE = 20;                  // 动态每页大小
    const FEED_CACHE_SIZE = 100;                // feed缓存条数
    const FEED_MFEED_USER_SIZE = 20;            // 点赞和关注聚合动态，用户数限制
    const FEED_MFEED_DETAIL_USER_SIZE = 4;          // 点赞和关注聚合动态，显示数据目
    const FEED_MFEED_DETAIL_PHOTO_SIZE = 6;          // 点赞和关注聚合动态，显示数据目
    const FEED_MFEED_CHANGE_TIME = 1;           // 关注和点赞聚合动态更新间隔时间，单位小时
    const FEED_MFEED_LIST_USER_SIZE = 10;       // 动态列表里面，需要显示聚合动态用户数
    const FEED_MFEED_DISPLAY_FOLLOW_USERS_SIZE = 4;// 聚合动态需要显示的头像数目
    const FEED_MFEED_DISPLAY_LIKE_PHOTOS_SIZE = 3; // 聚合动态需要显示的点赞图片数,只显示3张，去重作品，多选择几张
    const FEED_MFEED_INSERT_POS = 3;            // 关注、点赞聚合feed插入位置
    
    const FEED_FCOUNT_LESS_TEN = 100;            // 关注数少于10，补充达人的25条动态
    const FEED_FCOUNT_LESS_FOURTY = 15;         // 关注数少于40，补充达人的15条动态
    const FEED_FCOUNT_LESS_HURDRED = 10;        // 关注数少于100，补充达人的10条动态
    const FEED_FCOUNT_MORE_HURDRED = 5;         // 关注数多余100，补充达人的5条动态
    const FEED_QUERY_HOT_USER_SIZE = 30;        // 查询达人数
    const FEED_COMMENT_SIZE = 5;                // 保存动态最近评论条数
    const FEED_SHOW_COMMENT_SIZE = 5;           // FEED列表显示动态的条数
    const FEED_LATEST_TASK_AVATAR = "http://phototask.c360dn.com/FrMVwGlyY3Ed6JQEqU4l6PyHjM63"; 
    const FEED_LATEST_TASK_NICKNAME = "Camera360"; 
    const FEED_NO_LOGIN_EXPIRE_TIME = 600;      // 单位秒 未登录缓存刷新时间
    const FEED_TALENT_LIST_EXPIRE_TIME = 600;   // 单位秒 登陆达人列表缓存刷新时间
    const TASK_POS_ID_EXPIRE_TIME = 1800;       // 用户上次拉取首页挑战位的id记录缓存时间
    
    const FEED_STATUS_NO_FOLLOW = "none";
    const FEED_STATUS_HAS_FOLLOWS = "all";
    const FEED_STATUS_INIT = "init";
    const FEED_HAS_FOLLOW_REC_USER_SIZE = 12;
    
    const FEED_NO_LOGIN_USER_ID = "000000000000000000000000";
    const FEED_PUBLISH_TIPS = "记录生活的点滴";    // 首页发布动态提示语，以后改成配置，要区分语言
    
    const FEED_DEL_OPCODE = "feed.del";
    
    const FEED_VERSION = "7.9";

    const FEED_NICE_VIDEO_OPCODE = 'feed.niceVideo';

    const FEED_REC_WORK_OPCODE = 'feed.recWork';

    const FEED_REDIS = 'redis.feed';
}

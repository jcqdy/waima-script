<?php
/**
 * cache常用配置常量
 *
 *
 * @uses      CacheConst
 * @version   2015-12-22
 * @author    lilin <lilin@camera360.com>
 * @copyright Copyright 2010-2015 成都品果科技有限公司
 * @license PHP Version 5.x {@link http://www.php.net/license/3_0.txt}
 */
class CacheConst
{
    /* pg redis */
    const MSG_MANAGE = "cache.manage";
    const MSG_CACHE = "cache.msg";
    const MUSIC_CACHE = "cache.music";
    const PIC_CACHE = "cache.pic";
    const TASK_CACHE = "cache.task";
    const USER_CACHE = "cache.user";
    const USER_CACHE_COMMON = 'cache.userCommon';
    const CHANNEL_CACHE = "cache.channel";
    const COMMENT_CACHE =  "cache.comment";
    const FEED_CACHE =  "cache.feed";
    const REC_CACHE = "cache.rec";
    const DISCOVER_CACHE = 'cache.discover';
    const TRANSLATE_CACHE = 'cache.translate';
    const EMOTION_CACHE = 'cache.emotion';

    /* amazonaws redis */
    const MANAGE_REDIS = "redis.manage";
    const MANAGE_REDIS_UN_SERIALIZER = "redis.manage.unserializer";
    const MSG_REDIS = "redis.msg";
    const PIC_REDIS = "redis.pic";
    const REPORT_REDIS = "redis.report";
    const TASK_REDIS = "redis.task";
    const USER_REDIS = "redis.user";
    const CHANNEL_REDIS = "redis.channel";
    const COMMENT_REDIS = "redis.comment";
    const REC_REDIS = "redis.rec";
    const DISCOVER_REDIS = 'redis.discover';
    const FEED_REDIS = 'redis.feed';

    //task未序列化缓存
    const TASK_READ_UNSERIALIZER = "taskRead.unserializer";
    const TASK_WRITE_UNSERIALIZER = "taskWrite.unserializer";

    //pic未序列化缓存
    const PIC_READ_UNSERIALIZER = "picRead.unserializer";
    const PIC_WRITE_UNSERIALIZER = "picWrite.unserializer";

    const USER_READ_UNSERIALIZER = "userRead.unserializer";
    const USER_WRITE_UNSERIALIZER = "userWrite.unserializer";

    //feed未序列化缓存
    const FEED_UNSERIALIZER = 'feed.unserializer';

    // manage 缓存key
    const MANAGE_MALLSWITCH     = "MallSwitch";

    // msg 缓存key
    const MSG_USER_TIMEZONE = "device_timezone_";      //用户时区缓存key
    const MSG_USER_UNREAD = "msg_user_unread_";        //用户未读书缓存key
    const MSG_USER_NEW_FANS = "msg_user_new_fans_";    //用户新粉丝缓存key
    const MSG_SYS_UPDATE  = "sysMsgUpdate";            //系统消息更新时间key
    const MSG_USER_UPDATE = "sys_user_update_";        //系统消息用户更新key
    const MSG_GET_FANS_TIME = "get_user_fans_time_";
    const MSG_SET_FANS_TIME = "set_user_fans_time_";
    const MSG_SET_LIKE_TIME = "set_user_like_time_";
    const MSG_GET_LIKE_TIME = "get_user_like_time_";
    const MSG_SYS_LIST      = "sysMsgList";
    const MSG_PUSH_COUNT    = "msgPushCount_"; 

    // pic 缓存key
    const PIC_VOTE_SET           = "voteSet";          //被投票照片的有序集合的前缀
    const PIC_VOTE_INDEX         = "voteIndex_";       //投票集合的索引位置
    const PIC_RANKING_SET        = "rankingSet_";      //照片排名的有序集合的前缀
    const PIC_NICE_WORKS         = "niceWorks_";       //任务being阶段任务优秀照片key的前缀
    const PIC_BEGIN_WORKS        = "beginWorks_";      //任务begin阶段的任务作品key前缀
    const PIC_ALL_VOTE_SUM       = "all_vote_sum_";    //一个任务的总投票数
    const PIC_LIKE_VOTE_SUM      = "like_vote_sum";    //一个任务的总喜欢票数
    const PIC_TASK_LIST          = "taskList_";        //任务列表的照片的前缀
    const PIC_MY_VOTES           = "myVotes_";         //我投过票的照片
    const PIC_VOTE_GEO           = "voteGeo_";         //投票的geo信息
    const PIC_NEW_PICS           = 'new_pics_';        //未满默认分发次数的照片集合key
    const PIC_WATCH_SUM_SHORT    = '_w';               //记录照片浏览数的key
    const PIC_VOTE_SUM_SHORT     = '_v';               //记录照片喜欢票数的key
    const PIC_UNLIKE_SUM_SHORT   = '_u';               //记录照片不喜欢票数的key
    const PIC_COUNTERS           = 'counters_';        //以任务为单位存储照片的各个计数的HashMap
    const PIC_TASK_LIST_AUTH     = 'taskListAuth_';    //任务列表的用户数据
    const WORK_COUNTERS          = 'workCounters';     //存储所有作品的计数的HashMap
    const LIKE_SUM               = 'l_';               //作品计数的hashMap中，存储点赞数的field
    const COMMENT_SUM            = 'c_';               //作品计数的hashMap中，存储评论数数的field
    const PIC                    = 'pic_';             //每个作品的缓存

    // task 缓存key
    const TASK_LIST_KEY_V2       = "task_list_data_key_V2";  //所有任务列表数据key(排序值)
    const TASK_LIST_KEY          = "task_list_data_key";     //所有任务列表数据key
    const TASK_DETAIL_KEY        = "task_detail_";           //任务详情
    const TASK_WATCH_TASK_ADD_CS = "task_watch_add_cs_";     //用户查看task获取积分、经验
    const TASK_WATCHCOUNTER      = 'watchCounter_';          //任务浏览数
    const TASK_GAME_DETAIL       = 'task_game_detail_';      //PhotoGame详情
    const TASK_GAME_WORK_DETAIL  = 'task_game_work_detail_'; //PhotoGame work详情,id为workId_gameId
    const TASK_HOT_GAME_IDS      = 'task_hot_game_ids_';     // 热门game id
    const TASK_GAME_HOT_WORK_IDS = 'task_game_hot_work_ids_'; // game下热门作品.

    // user 缓存key
    const USER_DEVICE_PREFIX     = "user_device_";
    const FOLLOW_IDS             = 'followIds_';           //关注的人的userIds缓存
    const USER_FOLLOW_UIDS       = 'user_follow_new_uids_';    //关注的人的userIds缓存(new)
    const USER_NOTICE_CONF       = 'user_notice_conf_';    //用户消息通知配置
    const USER_COUNTERS          = 'userCounters';         //存储所有用户的计数的HashMap
    const USER_LIKE_SUM          = 'u_l_';                 //用户点赞数
    const USER_COMMENT_SUM       = 'u_c_';                 //用户评论数
    const USER_FEED_SUM          = 'u_f_';                 //用户feeds数
    const USER_BAN               = 'userBan';              // 用户封号 禁言 HASHMAP
    const USER_TYPE_PREFIX       = 'userType';            // 用户类型
    const USER_FEEDS_TEMP        = 'userFeedsTemp';           //用户feeds 个人主页缓存用
    const USER_WORK_LIKE_TEMP    = 'userWorkLikeTemp';     //用户作品喜欢  个人主页缓存用

    // channel 缓存key
    const CHANNEL_HOT_PHOTOS_WRITE = "hot_photos_write_";   //热门照片
    const CHANNEL_HOT_PHOTOS_READ  = "hot_photos_read_";    //热门照片
    const CHANNEL_HOT_VIDEOS_WRITE = "hot_videos_write_";   //热门视频
    const CHANNEL_HOT_VIDEOS_READ  = "hot_videos_read_";    //热门视频
    const CHANNEL_DAY_HOT_WRITE    = 'day_hot_write_';      //当日热门挑战内容
    const CHANNEL_DAY_HOT_READ     = 'day_hot_read_';       //当日热门挑战内容
    const CHANNEL_STICKER_WRITE    = 'sticker_write_';      //精选贴纸内容
    const CHANNEL_STICKER_READ     = 'sticker_read_';       //精选贴纸内容

    // comment 缓存key
    const COMMENT_COMMENT       = "comment_";               // 单条评论
    const COMMENT_COMMENT_IDS   = "comment_ids_";           // 评论id缓存
    const BADWORDS              = 'badwords';               // 敏感词
    const COMMENT_LIKE          = "like_";                  // 单条like
    const COMMENT_LIKE_DATA     = "like_data_";             // 点赞数据缓存
    const COMMENT_LIKE_USER_WORKIDS     = "like_user_workids_"; // 用户点赞过的作品

    //feed 缓存key
    const USER_FEED             = 'user_feed_';
    const FEED_CONTENT          = 'feed_content_';
    const USER_UPFEED_TIME      = 'user_upfeed_time_';      // 用户最后操作时间记录 hashMap
    const UPFEED                = 'upFeed';                 // 用户最后操作时间记录中记录上次更新动态的时间的field
    const UPFOLLOW              = 'upFollow';               // 用户最后操作时间记录中记录上次关注别人的时间的field
    const UPLIKE                = 'upLike';                 // 用户最后操作时间记录中记录上次点赞的时间的field
    const USER_FEED_TIME        = 'user_feed_time_';        // 用户动态列表创建时间
    const USER_MFEED_TIME       = "user_mfeed_time_uid_";   // 用户聚合动态生产时间
    const FEED_LATEST_CIDS      = "feed_lastest_cids_";     // 动态最近几条评论信息
    const USER_LASTEST_FEED     = "user_lastest_feed_";     // 最近一条feed
    const FEED_TALENT_LIST      = "feed_talent_list_";      // 动态达人缓存列表
    const USER_IN_PHOTO_GAME    = "user_photo_game_";       // 参与photogame的用户缓存
    const REC_WORK              = 'recWork_';               // 精选作品的缓存key
    const TASK_POS_ID           = 'taskPosId_';             // 用户上次拉取首页挑战位的id记录

    // rec 缓存key
    const REC_HOT_USERS_WRITE   = "hot_users_write_";       // 红人推荐写
    const REC_HOT_USERS_READ    = "hot_users_read_";        // 红人推荐读
    const REC_USERS             = "users_";                 // 推荐用户

    // translate 缓存key
    const TRANSLATE_ID          = 'translate_';             // 翻译后内容缓存
    const TRANSLATE_TRANSLATOR_KEY  = 'translate_transtor_key_';             // 翻译后内容缓存

    // emotion 缓存key
    const EMOTICON_ID           = 'emoticon_';              // 动态表情缓存
    const EMOTICON_PKG_ID      = 'emoticonPkg_';          // 动态表情包缓存

    //discover 缓存key
    const NEW_WORK = 'newWork_';                            //新作品有序集合
    const HOT_TASK = 'hotTask_';                            //编辑推荐热门挑战
    const HOT_TASK_TEMP = 'hotTaskTemp';                    //编辑推荐热门挑战(临时缓存key)
    const OVER_TASK = 'overTask_';                          //已结束挑战的数据
    const OVER_TASK_TEMP = 'overTaskTemp_';                 //已结束挑战的数据(临时缓存key)
    const NICE_WORK = 'niceWork_';                          //编辑推荐优秀作品
    const NICE_USER = 'niceUser_';                          //编辑推荐优秀用户
    const OPERATION = 'operation_';                         //广场运营位
    const HOT_VIDEO = 'hotVideo';                           //热门视频
    const HOT_VIDEO_TEMP = 'hotVideoTemp';                  //热门视频(临时缓存key))
    const FIXED_HOT_VIDEO = 'fixedHotVideo';                //广场一级页面,精选视频封面数据缓存key
    const HOT_VIDEO_DEG = 'hotVideoDeg_';                   //热门视频(服务降级缓存)
    const FALLS_WORK_SP = 'fallsWorkSp_';                   //瀑布流作品分页
    const FALLS_WORK_SP_TEMP = 'fallsWorkSpTemp_';          //瀑布流作品分页(临时缓存key)
    const FALLS_TALENT_SP = 'fallsTalentSp_';               //瀑布流达人分页
    const REC_CONF = 'recConf_V2_';                         //广场编辑推荐配置
    const REC = 'rec_';                                     //精选专题的缓存
    const REC_CONF_TEMP = 'recConfTemp_';                   //广场编辑推荐配置(在后台修改配置时生成的临时缓存)
    const REC_VIDEO = 'recVideo_';                          //广场精选视频
    const REC_VIDEO_TEMP = 'recVideoTemp_';                 //广场精选视频(在后台修改配置时生成的临时缓存)
    const NEARBY_USER = 'nearbyUser_';                      //附近的人二级页面
    const TOP_REC = 'topRec_';                              //置顶的编辑精选
    const FALLS_REC_SP = 'fallsRecSp_';                     //瀑布流中编辑精选分页缓存
    const FALLS_PHOTOGAME_SP = 'fallsPhotoGameSp_';         //瀑布流中PhotoGame分页缓存
    const REC_SP = 'recSp_';                                //编辑精选列表页的分页缓存key
    const SETS_BRIDGE = 'setsBridge';                       //在更新集合数据时,配合sDiffStore指令,用于数据过渡的key
    const SQUARE_TASK_INFO = 'squareTaskInfo_';             //广场一级页面挑战信息的本机缓存key
    const NEWEST_REC = 'newestRec_V2';                      //广场一级页面最新配置的推荐内容缓存key
    const REC_CONF_PUSH_LIST = 'recConfPushList';           //精选专题发push的等待队列
}

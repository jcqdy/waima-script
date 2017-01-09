<?php
/**
 * 消息模块常量
 *
 * @uses      MsgConst
 * @version   2015-12-19
 * @author    liwei <liwei@camera360.com>
 * @copyright Copyright 2010-2015 成都品果科技有限公司
 * @license PHP Version 5.x {@link http://www.php.net/license/3_0.txt}
 */
class MsgConst
{
    /*客户端平台*/
    const PLATFORM_IOS = "ios";              //ios
    const PLATFORM_ANDROID = "android";      //安卓
    
    //默认时区
    const DEFAULT_TIME_ZONE = "Asia/Shanghai";
    
    /*android推送消息类型*/
    const PLATFORM_ANDROID_GENERAL = 1;     //一般消息
    const PLATFORM_ANDROID_OUT_LINK = 2;    //外链消息
    const PLATFORM_ANDROID_INNER_LINK = 1;  //内链消息
    const PLATFORM_ANDROID_POPUP = 3;       //弹窗消息
    
    const USER_VOTE_TYPE = 1;          //用户投票消息
    const TASKEND_VOTE_TYPE = 2;       // 任务结束消息
    const GUEST_VOTE_TYPE = 3;         //匿名投票消息
    const MERGEGUEST_VOTE_TYPE = 4;    //匿名聚合消息
    const MERGEGUEST_COLLECT_TYPE = 5; //收藏消息
    const USER_PHOTO_SELECT_TYPE = 6;  //后台用户图片精选消息
    const COMMENT_MSG_TYPE = 7;//评论消息
    const FOLLOW_MSG_TYPE = 8;//关注粉丝消息
    const LIKE_MSG_TYPE = 9;//点赞消息
    const AT_USER_COMMENT = 10; // 评论@用户
    const AT_USER_PIC = 11; // 发图@用户 
    const SYS_MSG_TYPE = 12; // 系统消息
    const AT_USER_RELAY = 13; // 接力@用户
    const TALENT_MSG_TYPE = 14; // 获取达人
    const CHOICEUSER_MSG_TYPE = 15; // 获取精选用户
    const CHOICEVIDEO_MSG_TYPE = 16; // 获取精选视频
    const CHOICETOPIC_MSG_TYPE = 17; // 获取精选专题
    const TALENT_APPLY_MSG_TYPE = 18; // 达人审核
    const RECWORK_MSG_TYPE = 19; // 精选作品
    const VIP_MSG_TYPE = 20; // 认证用户
    
    const COMTYPE_COM    = 1; // 评论
    const COMTYPE_RE     = 2; // 回复
    const COMTYPE_RE_MAS = 3; // 回复，主人
    
    const USER_VOTE_TYPE_NAME = 'vote';            //用户投票消息
    const TASKEND_VOTE_TYPE_NAME = 'ranking';      // 任务结束消息
    const GUEST_VOTE_TYPE_NAME = 'guestMsg';       //匿名投票消息
    const MERGEGUEST_VOTE_TYPE_NAME = 'mergeVote'; //匿名聚合消息
    const MERGEGUEST_COLLECT_TYPE_NAME = 'collect'; //收藏消息
    const USER_PHOTO_SELECT_TYPE_NAME = 'select'; //精选消息
    const COMMENT_MSG_TYPE_NAME = 'comment';//评论消息
    const FOLLOW_MSG_TYPE_NAME = 'follow';//评论消息
    const LIKE_MSG_TYPE_NAME = "like";//点赞消息
    const SYS_MSG_TYPE_NAME = "sysMsg"; // 系统消息
    const AT_MSG_TYPE_NAME = 'at'; // AT消息
    const RELAY_MSG_TYPE_NAME = 'relay'; // 接力消息
    const TALENT_MSG_TYPE_NAME = 'talent'; // 获取达人
    const CHOICEUSER_MSG_TYPE_NAME = 'choiceUser'; // 获取精选用户
    const CHOICEVIDEO_MSG_TYPE_NAME = 'choiceVideo'; // 获取精选视频
    const CHOICETOPIC_MSG_TYPE_NAME = 'choiceTopic'; // 获取精选专题
    const TALENT_APPLY_MSG_TYPE_NAME = 'talentApply'; // 达人申请
    const RECWORK_MSG_TYPE_NAME = 'recWork'; // 精选作品
    const VIP_MSG_TYPE_NAME = 'vip'; // 认证用户
    
    const IOS_RANKING_MSG_VERSION = '7.0.9';
    const ANDROID_RANKING_MSG_VERSION_ONE = '7.1beta';
    const ANDROID_RANKING_MSG_VERSION_TWO = '7.1.1beta';
    
    const GUEST_SENDERID = '55ee4ed4ce1cdd400466d547'; //
    const GUEST_NICKNAME = ''; //
    const GUEST_AVATAR = ''; //
    
    const SYSTEM_SENDERID = '55c8052bce1cdd73020528db'; //
    const SYSTEM_NICKNAME = 'system'; //
    const SYSTEM_AVATAR = ''; //
    
    const GOTO_ANDROID_ACHIEVEMENT = 'app://camera360/achievement?picId='; //android 成就页
    const GOTO_ANDROID_HOMEPAGE = 'app://camera360/homepage?userId=';      //android 用户主页
    const GOTO_ANDROID_MESSAGE_LIST = "app://inspire/pcmessagelist";       //andorid 消息页面
    const GOTO_ANDROID_COMMENT = 'app://inspire/comment';          //评论页
    const GOTO_ANDROID_ATTENTION = 'app://inspire/attention';              //关注页
    const GOTO_ANDROID_PCWORKDETAIL = "app://camera360/workDetail?workId="; //作品详情页
    const GOTO_ANDROID_PCWORKDETAIL_NEW = "app://camera360/workdetail?work_id="; //作品详情页 for v8.0 及以后
    const GOTO_ANDROID_AT = "app://inspire/at";                     //@页
    const GOTO_ANDROID_LIKE = "app://inspire/like";                    //赞
    const GOTO_ANDROID_VOTE = "app://inspire/vote";                   //投票
    const GOTO_ANDROID_AWARD = "app://inspire/award";                       //获奖
    const GOTO_ANDROID_SYSMSG = "app://inspire/system";                     //系统消息 push
    const GOTO_ANDROID_NICEUSER = "app://discovery/niceuser";          // 热门用户
    const GOTO_ANDROID_NICEWORK = "app://discovery/nicework";           // 热门作品
    const GOTO_ANDROID_HOTVIDEO = "app://inspire/hotvideo";
    const GOTO_ANDROID_PROFILE  = "app://inspire/profile";
    const GOTO_ANDROID_TALENT_APPLY = "app://inspire/applydresser";
    
    const GOTO_IOS_MESSAGE_LIST = "camera360://1.2/pcmessagelist";         //iso 消息列表页面
    const GOTO_IOS_PCACHIEVE = 'camera360://1.0/pcachieve?picId=';         //ios 成就页
    const GOTO_IOS_PCWORKDETAIL = "camera360://1.3/pcworkdetail?workid="; //作品详情页
    const GOTO_IOS_COMMENT = 'camera360://1.3/pcmediadetail?workid=';       //评论页
    const GOTO_IOS_SYSMSG   = "camera360://1.2/pcmessagelist";                     //系统消息 push
    const GOTO_IOS_NICEUSER = "camera360://1.2/pc_square_outstanding_users";          // 热门用户
    const GOTO_IOS_NICEWORK = "camera360://1.2/pc_square_outstanding_works";           // 热门作品
    const GOTO_IOS_HOTVIDEO = "camera360://1.2/hotvideolist";
    const GOTO_IOS_PROFILE  = "camera360://1.2/pchomePage";
    const GOTO_IOS_TALENT_APPLY = "camera360://1.2/applydresser";
    
    const DEFAULT_LANGUAGE = 'en_us';    //默认语言
    
    //证书渠道
    const APP_CHANNEL_GOOGLE_MARKET = "GoogleMarket";
    const APP_CHANNEL_XIAOMI = "小米";
    
    //推送证书平台，其他真实渠道（归到umeng）
    const PUSH_CHANNEL_GETUI = "getui";
    const PUSH_CHANNEL_XIAOMI = "xiaomi";
    const PUSH_CHANNEL_GOOGLE_MARKET = "gcm";
    const PUSH_CHANNEL_UMENG = "umeng";
    
    const DEFAULT_TIMEZONE_OFFSET = 8;//默认时区偏移量
    
    const MSG_GROUP_COMMENT = "comment";    // 评论消息
    const MSG_GROUP_NEW_FANS = "fans";      // 关注粉丝消息
    const MSG_GROUP_AWARD = "award";        // 获奖消息组
    const MSG_GROUP_SYS_MSG = "sysMsg";     // 系统消息
    const MSG_GROUP_LIKE = "like";          // 点赞消息
    const MSG_GROUP_AT = "at";              // @消息 
    const MSG_GROUP_VOTE = "vote";          // 投票消息
    
    const MSG_PAGE_SIZE = 30;
    const MEDIA_PHOTO = "photo";
    const MEDIA_VIDEO = "video";
    
    const MSG_NEW_FAN_LIST_SIZE = 10;       // 未读新粉丝列表长度
    const MSG_UNREAD_COMMENT = "comment"; // 评论未读书
    const MSG_UNREAD_FANS = "fans";         // 新粉丝数
    const MSG_UNREAD_AWARDS = "awards";     // 获奖通知消息
    const MSG_UNREAD_LIKE = "like";          // 点赞消息
    const MSG_UNREAD_AT = "at";              // @消息
    const MSG_UNREAD_SYS_MSG = "sysMsgs";   // 系统消息
    const MSG_UNREAD_VOTE = "vote";         // 投票消息
    const MSG_UNREAD_BADGE = "badge";       // badge外层计数
    
    const MSG_SYS_MSG_COUNT = "sysMsgCount"; // 系统消息总数
    
    const MSG_SYS_MSG_PIC = "http://c360-o2o.c360dn.com/579898bad5681"; // 系统消息默认图片
    const MSG_SYS_MSG_TALENT_PIC = "http://c360-o2o.c360dn.com/5850aa7dec1a5";
    const MSG_SYS_MSG_NICEVIDEO_PIC = "http://c360-o2o.c360dn.com/57bcfa42d5cc3";
    const MSG_SYS_MSG_VIP_PIC = "http://c360-o2o.c360dn.com/5850aaae53d11";
}

<?php
/**
 * 任务模块常量
 * 
 * @uses      TaskConst
 * @version   2015-12-19
 * @author    liwei <liwei@camera360.com>
 * @copyright Copyright 2010-2015 成都品果科技有限公司 
 * @license PHP Version 5.x {@link http://www.php.net/license/3_0.txt}
 */
class TaskConst
{
    const TASK_CACHE                    = 'cache.task';
    const TASK_REDIS                    = 'redis.task';
    const REDIS_READ_UNSERIALIZER       = 'taskRead.unserializer';
    const REDIS_WRITE_UNSERIALIZER      = 'taskWrite.unserializer';

    const USER_REDIS                    = 'redis.user';
    
    const MANAGE_TASKEND_TYPE           = 'manage.taskEnd';   //任务结束mq
    const MANAGE_BACKONLINE_TYPE        = 'manage.backOnline';  //任务重新上线mq
    const TASK_MQ_WATCHTASK             = 'task.watchTaskList';  //进入任务列表加积分
    
    const AWARD_STATUS_NORECEIVE        = "noreceive"; // 未领取

    const AWARD_STATUS_RECEIVED         = "received"; // 已领取
    
    const AWARD_TYPE_CASH               = "cash"; // 现金

    const AWARD_TYPE_ENTITY             = "entity";//实物
    
    const AWARD_TYPE_CASH_NUM           = 3;  //任务现金奖励类型
    const AWARD_TYPE_ENTITY_NUM         = 2;//任务实物奖励类型
    const AWARD_TYPE_COUPON_NUM         = 1;//任务优惠券奖励类型
    
    const TASK_STATUS_INIT              = 0;    //初始化
    const TASK_STATUS_INIT_NAME         = '初始化'; 
    const TASK_STATUS_INIT_NEXTOP       = '灰度发布';   
    
    const TASK_STATUS_PREPUBLISH        = 1;    //灰度发布
    const TASK_STATUS_PREPUBLISH_NAME   = '灰度发布';   
    const TASK_STATUS_PREPUBLISH_NEXTOP = '正式发布';    
    
    const TASK_STATUS_PUBLISH           = 2;    //已发布
    const TASK_STATUS_PUBLISH_NAME      = '已发布';   
    const TASK_STATUS_PUBLISH_NEXTOP    = '紧急下线';    
    
    const TASK_STATUS_DISABLE           = 3;    //已下线
    const TASK_STATUS_DISABLE_NAME      = '已下线';   
    const TASK_STATUS_DISABLE_NEXTOP    = '灰度发布';   
    
    const TASK_STATUS_DELETED           = 4;    //已删除
    const TASK_STATUS_DELETED_NAME      = '已删除';   
    const TASK_STATUS_DELETED_NEXTOP    = '无';    //已删除
    
    const TASK_STATUS_FINISHED          = 10;   //已过期
    const TASK_STATUS_FINISHED_NAME     = '已过期';  
    const TASK_STATUS_FINISHED_NEXTOP   = '紧急下线';   
    
    const TASK_TYPE                     = 1;//
    const TASK_FINISH                   = 1;//已结束
    
    const WORKSSTATUS_INIT              = 1;  //开始
    const WORKSSTATUS_RUN               = 2;   //进行中
    const WORKSSTATUS_END               = 3;   //结束
    
    const TASK_FINISH_YES               = 1; //任务已经结束
    const TASK_FINISH_NO                = 0; //任务未结束
    
    const TASK_AWARD_YES                = 1; //已经领奖
    const TASK_AWARD_NO                 = 0; //未领奖
    
    const ALLCHANNEL                    = 'allchannel'; //所有渠道默认值
    const LOCATION_GLOBAL               = 'global'; //全球
    
    const TASK_LIST_CPOINT              = 0;  //积分
    const TASK_LIST_SCORE               = 2;  //经验
    
    const TASK_PICSUM_CN_BASE           = 7;
    const TASK_PICSUM_FOREIGN_BASE      = 3;
    const TASK_PICSUM_CN_INC            = 5;
    const TASK_PICSUM_FOREIGN_INC       = 5;
    
    const TASK_WATCHSUM_CN_BASE         = 7;
    const TASK_WATCHSUM_FOREIGN_BASE    = 3;
    const TASK_WATCHSUM_CN_INC          = 5;
    const TASK_WATCHSUM_FOREIGN_INC     = 5;
    
    const VOTEAWARD                     = "20";  //任务列表每天加积分
    
    const TASK_PHOTO_TYPE               = 1;//照片任务类型
    const TASK_VIDEO_TYPE               = 2;//视频任务类型

    const WORK_TYPE_PIC                 = 1;
    const WORK_TYPE_VIDEO               = 2;
    const WORK_TYPE_MULTI               = 3;
    const WORK_TYPE_VR                  = 4;

    const TASK_CHOICENESS       = 'taskChoiceness_';       //任务列表照片精选的redis前缀
    const VOTE_SET              = 'voteSet';               //被投票照片的有序集合的前缀
    const VOTE_INDEX            = 'voteIndex_';            //投票集合的索引位置
    const RANKING_SET           = 'rankingSet_';           //照片排名的有序集合的前缀
    const NICE_WORKS            = 'niceWorks_';            //任务being阶段任务优秀照片key的前缀
    const BEGIN_WORKS           = 'beginWorks_';           //任务begin阶段的任务作品key前缀
    const ALL_VOTE_SUM          = 'all_vote_sum_';         //一个任务的总投票数
    const LIKE_VOTE_SUM         = 'like_vote_sum';         //一个任务的总喜欢票数
    const TASK_LIST             = 'taskList_';             //任务列表的照片的前缀
    const MY_VOTES              = 'myVotes_';              //我投过票的照片
    const VOTE_GEO              = 'voteGeo_';              //投票的geo信息
    const TASK_LIST_KEY         = 'task_list_key';         //任务列表的缓存key
    const TASK_KEY              = 'task_detail_';          //单个任务缓存key
    const NEW_PICS              = 'new_pics_';             //未满默认分发次数的照片集合key
    const PIC_WATCH_SUM_SHORT   = '_w';                    //记录照片浏览数的key
    const PIC_VOTE_SUM_SHORT    = '_v';                    //记录照片喜欢票数的key
    const PIC_UNLIKE_SUM_SHORT  = '_u';                    //记录照片不喜欢票数的key
    const PIC_COUNTERS          = 'counters_';             //存储照片的各个计数的HashMap

    const VOTE_MSG_TYPE         = 1;                       //投票生成消息的类型
    const TASKEND_MSG_TYPE      = 2;                       //任务结束生成消息的类型
    const WORKS_STATUS_BEGIN    = 1;                       //任务作品第一状态
    const WORKS_STATUS_BEING    = 2;                       //任务作品第二状态
    const WORKS_STATUS_OVER     = 3;                       //任务作品第三状态

    const VOTE_OPCODE           = 'pic.sendVote';          //投票消息的opcode
    const ADD_PIC_OPCODE        = 'pic.addPic';            //上传照片的opcode
    const WRITE_VOTE_OPCODE     = 'pic.writeVote';         //异步写投票数据的opcode
    const WORKS_STATUS_OPCODE   = 'pic.worksStatus';       //修改任务的作品状态
    const TASK_END              = 'pic.taskEnd';           //任务结束脚本生成消息，排名数据
    const END_PUSH              = 'pic.endPush';           //任务结束的push
    const DEL_PIC               = 'pic.delPic';            //删除照片
    const RECOVER_PIC           = 'pic.recoverPic';        //恢复已删除的作品
    
    const MONITOR_DEFAULT_TASK_ID = "569c36a04b2868624c124e2c";
    
    const TASK_PUBLISH_SORT = 10000;                       //进行中的任务序号加10000

    const ANTI_MODULE_CODE = 'work';                       //在反垃圾后台注册的模块code

    const PIC_CACHE_EXPIRE = 3600;                         //照片缓存过期时间

    /**
     * 发给消息队列的opcode
     */
    const OPCODE_ADD_GAME       = 'task.addGame';           // 添加game
    const OPCODE_JOIN_GAME      = 'task.joinGame';          // 参与game
}

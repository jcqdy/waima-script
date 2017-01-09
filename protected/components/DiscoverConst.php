<?php
class DiscoverConst
{
    const HOT_TASK_EXPIRE = 21600;                          //热门挑战缓存失效时间

    const OVER_TASK_EXPIRE = 86400;                         //已结束挑战精选作品的缓存失效时间

    const FALLS_WORK_SP_EXPIRE = 3600;                      //广场瀑布流作品分页缓存失效时间

    const FALLS_TALENT_SP_EXPIRE = 1800;                    //广场瀑布流作品分页缓存失效时间

    const FALLS_REC_SP_EXPIRE = 1800;                       //瀑布流中编辑精选分页缓存失效时间

    const NEARBY_USER_EXPIRE = 600;                         //附近的人二级页面缓存失效时间

    const REC_CONF_LOCAL_EXPIRE = 20;                       //广场推荐配置，本机缓存的失效时间

    const REC_EXPIRE = 1200;                                //精选专题缓存失效时间
    
    const FIXED_HOT_VIDEO_LOCAL_EXPIRE = 30;                //广场一级页面,精选视频封面数据本机缓存失效时间

    const NICE_USER_EXPIRE = 3600;                          //推荐用户缓存失效时间

    const NICE_USER_LOCAL_EXPIRE = 30;                      //推荐用户，本机缓存失效时间

    const NICE_WORK_EXPIRE = 86400;                         //推荐作品缓存失效时间

    const NICE_WORK_LOCAL_EXPIRE = 30;                      //推荐作品，本机缓存失效时间

    const REC_SP_LOCALE_EXPIRE = 30;                        //编辑精选列表页的分页缓存，本机缓存失效时间

    const FALLS_HOT_WORK_RATIO = 0.8;                       //广场瀑布流热门作品比例

    const FALLS_NEW_WORK_RATIO = 0.2;                       //广场瀑布流新作品比例

    const FALLS_TALENT_RATIO = 0.1;                         //广场瀑布流达人比例

    const FALLS_REC_RATIO = 0.1;                            //广场瀑布流编辑精选比例

    const FALLS_PHOTO_GAME_RATIO = 0.1;                     //广场瀑布流photoGame比例

    const FALLS_WORK_NUM = 500;                             //广场瀑布流每次下拉要生成的作品数量

    const HOT_VIDEO_NUM = 200;                              //广场热门视频每次下拉要生成的视频数量

    const REC_SP_NUM = 3;                                   //编辑精选列表页的分页缓存，缓存的页数

    const GET_PIC_BATCH = 'getPicBatch';                    //getPicBatch接口并发请求的key

    const IS_LIKE = 'isLike';                               //isLike接口并发请求的key

    const GET_UINFO_BY_UID = 'getUinfoByUid';               //getUinfoByUid接口并发请求的key

    const USER_NEWEST = 'userNewest';                       //userNewest接口并发请求的key

    const REC_SER_HOT_WORK = 'recSer_hotWork';              //推荐系统热门作品(本语系)接口并发请求的key

    const REC_SER_HOT_WORK_NOT_LANGUAGE = 'recSer_hotWork_notLanguage'; //推荐系统热门作品(非本语系)接口并发请求的key

    const REC_SER_HOT_USER = 'recSer_hotUser';              //推荐系统热门用户接口并发请求的key

    const REC_SER_HOT_PHOTO_GAME = 'recSer_hotPhotoGame';   //推荐系统热门photoGame接口并发请求的key

    const DISCOVER_NICE_USER_OPCODE = 'discover.niceUser';

    const DISCOVER_NICE_WORK_OPCDDE = 'discover.niceWork';

    const DISCOVER_NICE_VIDEO_OPCODE = 'discover.niceVideo';

    const SQUARE_TASK_INFO_LOCAL_EXPIRE = 30;               //广场一级页面挑战信息的本机缓存失效时间

    const SQUARE_TASK_INFO_EXPIRE = 600;                    //广场一级页面挑战信息的缓存失效时间

    const NEWEST_REC_LOCAL_EXPIRE = 30;                     //广场一级页面最新配置的推荐内容本机缓存失效时间

    const NEWEST_REC_EXPIRE = 1200;                         //广场一级页面最新配置的推荐内容缓存失效时间

    const SQUARE_REC_NUM = 10;                              //广场页展示的编辑精选的数量
}

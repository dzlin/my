<?php
namespace system\core;

/**
 * 权限操作编码
 *
 * 明名约定：类型_动作，如：NEWS_ADD
 *
 * @author zhanglin
 *        
 *         2015年8月22日 下午10:04:37
 *        
 */
class OCode
{
    // 新闻添加
    const NEWS_ADD = 'NEWS_ADD';

    const NEWS_EDIT = 'NEWS_EDIT';

    const NEWS_DELETE = 'NEWS_DELETE';

    const NEWS_LOOK = 'NEWS_LOOK';

    const NEWS_COMMENT = 'NEWS_COMMENT';

    const NEWS_COLLECT = 'NEWS_COLLECT';

    const NEWS_GOODS = 'NEWS_GOODS';

    const NEWS_STEP = 'NEWS_STEP';

    const NEWS_SHARE = 'NEWS_SHARE';

    const USER_ADD = 'USER_ADD';

    const USER_LOOK = 'USER_LOOK';

    const USER_EDIT = 'USER_EDIT';

    const USER_DELETE = 'USER_DELETE';

    const NEWS_AUDIT = 'NEWS_AUDIT';

    const NEWS_COMMENT_AUDIT = 'NEWS_COMMENT_AUDIT';

    const USER_AVATAR_AUDIT = 'USER_AVATAR_AUDIT';

    const USER_USERNAME_AUDIT = 'USER_USERNAME_AUDIT';
}
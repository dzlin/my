<?php

namespace system\core;

/**
 * 用户工具类
 * @author dzlin 
 * @datetime 2015-8-15  19:14:39
 */
class UserUtil
{

    /**
     * 加密用户登陆密码 encrypt
     * 
     * @param stirng $password 未加密的密码
     * @param string $salt
     * @return string 加密后的密码
     */
    public static function enPassword($password, $salt)
    {
        return md5(md5(sha1($password . $salt)));
    }

}

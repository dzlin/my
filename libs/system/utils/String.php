<?php

namespace system\utils;

/**
 * 字符串处理工具类
 * 
 * @author dzlin 
 * @datetime 2015-8-14  21:12:03
 */
class String
{

    /**
     * 字符串的简单xss过滤
     * 
     * @param string $str 要过滤的字符串，引用传递
     * @return string 返回过滤后的字符串
     */
    public static function filterXss(&$str)
    {
        return addslashes(htmlspecialchars($str));
    }

    /**
     * 邮箱格式验证
     * 
     * @param string $email 引用
     * @return boolean 是返回true，否则返回false
     */
    public static function isEmail(&$email)
    {
        $reg = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
        if (preg_match($reg, $email))
            return true;
        return false;
    }

    /**
     * 检查密码格式
     * @param type $password 密码，引用
     * @return boolean 是返回true
     */
    public static function isPassword(&$password)
    {
        $reg = '/^[a-zA-Z0-9]{8,32}$/';
        if (preg_match($reg, $password))
            return true;
        return false;
    }

}

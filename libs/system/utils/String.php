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

}

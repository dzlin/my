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

    /**
     * 生成salt
     * @return string 用户salt串
     */
    public static function randSalt()
    {
        return self::createRandStr(8);
    }

    /**
     * @param type $length
     * @return string
     */
    /* public static function getRandStr($length)
      {
      $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randString = '';
      $len = strlen($str) - 1;
      for ($i = 0; $i < $length; $i ++) {
      $num = mt_rand(0, $len);
      $randString .= $str[$num];
      }
      return $randString;
      }
     */

    /**
     * 随机获取长度为length的字符串，可能包含有大小写字母和数字
     * 
     * @param integer $length 随机字符串的长度 最大是1024
     * @return string 获取得到的随机字符串
     */
    public static function createRandStr($length)
    {
        if (!is_numeric($length) || $length > 1024)
            return;
        /*
         * 62个字符
         */
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $strlen = 62;
        while ($length > $strlen) {
            $str .= $str;
            $strlen += 62;
        }
        /**
         * str_shuffle随机打乱一个字符串
         */
        $str = str_shuffle($str);
        return substr($str, 0, $length);
    }

}

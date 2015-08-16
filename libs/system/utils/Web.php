<?php

namespace system\utils;

use system\core\Log;

/**
 * 应用工具类
 * 
 * @author dzlin 
 * @datetime 2015-8-15  17:04:35
 */
class Web
{

	/**
	 * 是否是post类型请求
	 * @return boolean
	 */
	public static function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
			return true;
		return false;
	}

	/**
	 * 是否是get请求
	 * @return boolean
	 */
	public static function isGet()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'GET')
			return true;
		return false;
	}

	/**
	 * 检查post或是get数据是否完整
	 * 
	 * @param array $fields & 要检查的index数组
	 * @param type $isGet 是否是GET数据，默认false
	 * @return boolean|int 完整返回true，参数错误返回false
	 * 有错误返回第几个index没有设置
	 */
	public static function checkPostData(&$fields, $isGet = false)
	{
		if (!is_array($fields) || !is_bool($isGet))
			return false;
		$count = 0;
		foreach ($fields as $v) {
			++$count;
			if (($isGet && !isset($_GET[$v])) ||
					(!$isGet && !isset($_POST[$v])))
				return $count;
		}
		return true;
	}

	/**
	 * 发送404信息并推出，简单的日志记录
	 */
	public static function echo404($msg = '')
	{
		/**
		 * 简单的日志记录
		 */
		Log::write($msg, '404');
		/**
		 * 返回404
		 */
		header('HTTP/1.1 404 Not Found');
		header('Status:404 Not Found');
		exit;
	}

}
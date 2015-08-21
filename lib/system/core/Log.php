<?php

namespace system\core;

/**
 * 日志记录类
 * 
 * @author dzlin 
 * @datetime 2015-8-16  10:15:19
 */
class Log
{

	/**
	 * 日记记录
	 * @param type $msg 要记录的信息
	 * @param string $mark 标记，方便查找，默认INFO
	 */
	public static function write($msg, $mark = 'INFO')
	{
		/**
		 * 年份的目录
		 */
		$year = LOG_DIR . '/' . date('Y');
		if (!file_exists($year))
			mkdir($year, 0755);
		/**
		 * 月份的目录
		 */
		$month = LOG_DIR . '/' . date('Y') . '/' . date('m');
		if (!file_exists($month))
			mkdir($month, 0755);
		/**
		 * 做日志记录
		 */
		$log = LOG_DIR . '/' . date('Y') . '/' . date('m') . '/';
		$log .= date('d') . '.log';
		$fp = fopen($log, 'a');
		if ($fp) {
			$content = '[' . $mark . '] ';
			$content .= date('H:i:s') . ' ' . $msg . "\n";
			$content .= $_SERVER['REMOTE_ADDR'] . ' ';
			$content .= $_SERVER['REQUEST_URI'] . '?';
			$content .= $_SERVER['QUERY_STRING'] . "\n\n";
			fwrite($fp, $content);
			fclose($fp);
		}
	}

}

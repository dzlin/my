<?php

/**
 * redis 配置项
 */
return array(
	'host' => '127.0.0.1',
	'port' => 6379,
//    'timeout' => 0,
	/**
	 * 用户缓存前缀
	 * 用户ID是12，则key是：u12
	 */
	'userPrefix' => 'u',
	/**
	 * 社团缓存前缀
	 * 社团ID是10，则key是：a10
	 */
	'assnPrefix' => 'a'
);

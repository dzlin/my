<?php

/**
 * 
 * 变量定义文件，所有的可请求页面都必须要包含
 * 
 * 注册类自动加载函数
 * 
 * @date 15-8-14 下午8:51
 * @author dzlin
 */
//启动SESSION
session_start();

//程序开始执行时间
define('START_TIME', microtime(true));

//时间戳
define('TIMESTAMP', time());

//程序根目录
define('PATH_ROOT', dirname(__FILE__));

//类库目录
define('CLASSPATH', PATH_ROOT . '/libs');

//配置文件目录
define('CONFIG_DIR', PATH_ROOT . '/config');

//文件上传目录
define('UPLOADS', PATH_ROOT . '/uploads');


//引入类自动加载函数文件
require 'autoload.php';

//注册类自动加载函数
spl_autoload_register('autoload');

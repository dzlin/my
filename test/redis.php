<?php

require '../init.php';

/**
 * system\core\Redis 简单测试
 */
use system\core\Redis as IRedis;

$redis = new IRedis();

//set
//$value = 'zhangsan';
//$redis->set('user', $value);

//get
//$redis->get('user', $return);
//echo $return;

//del
//$redis->del('user');

//$redis->get('user', $return);
//var_dump($return);

//clear
//$redis->clear();

//close
$redis->close();

//报错
//$value = 'zhangsan';
//$redis->set('user', $value);


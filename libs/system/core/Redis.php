<?php

namespace system\core;

/**
 * Redis 操作类 主要用于缓存或简单数据存储
 * 
 * @author dzlin 
 * @datetime 2015-8-16  0:39:57
 */
class Redis
{

	/**
	 * Redis 操作实例
	 * @var type 
	 */
	private $redis = null;

	/**
	 * 构造函数
	 * @param string $host redis 主机
	 * @param integer $port redis 端口
	 */
	public function __construct($host = '127.0.0.1', $port = 6379)
	{
		$this->redis = new \Redis();
		$this->redis->connect($host, $port);
	}

	/**
	 * 关闭连接
	 */
	public function close()
	{
		if ($this->redis !== null)
			$this->redis->close();
	}

	/**
	 * 设置key的值value
	 * 
	 * @param type $key 键
	 * @param type $value 值 &
	 * @param type $expire 过多长时间后失效，单位是秒，0表示无限
	 * @return type 执行成功返回true
	 */
	public function set($key, &$value, $expire = 0)
	{
		//对数组/对象数据进行缓存处理，保证数据完整性
		$value = (is_object($value) || is_array($value)) ?
				json_encode($value) : $value;
		if (is_int($expire) && $expire)
			$result = $this->redis->setex($key, $expire, $value);
		else
			$result = $this->redis->set($key, $value);
		return $result;
	}

	/**
	 * 获取值
	 * 
	 * @param string $key
	 * @return array|string
	 */
	public function get($key, &$return)
	{
		$value = $this->redis->get($key);
		/**
		 * true参数是返回array，而不是object
		 */
		$jsonData = json_decode($value, true);
		/**
		 *  检测是否为JSON数据 true 返回JSON解析数组, false返回源数据
		 */
		$return = ($jsonData === NULL) ? $value : $jsonData;
	}

	/**
	 * 删除key
	 * 
	 * @param string $key
	 * @return integer 成功删除返回1
	 */
	public function del($key)
	{
		return $this->redis->delete($key);
	}

	/**
	 * 清除数据
	 * @return boolean
	 */
	public function clear()
	{
		return $this->redis->flushDB();
	}

}

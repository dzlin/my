<?php

namespace system\core;

/**
 * 配置文件访问类
 * 
 * @author dzlin 
 * @datetime 2015-8-15  15:08:45
 */
class Config implements ArrayAccess
{

    protected $path; // 配置文件自动加载
    protected $configs = array(); // 加载的配置项

    function __construct($path)
    {
        $this->path = $path;
    }

    public function offsetExists($offset)
    {
        return isset($this->configs[$offset]);
    }

    public function offsetGet($offset)
    {
        if (empty($this->configs[$offset])) {
            $file_path = $this->path . '/' . $offset . '.php';
            $config = require $file_path;
            $this->configs[$offset] = $config;
        }
        return $this->configs[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->configs[$offset] = $value;
        //throw new \Exception("Can not write the config file.");
    }

    public function offsetUnset($offset)
    {
        unset($this->configs[$offset]);
    }

}

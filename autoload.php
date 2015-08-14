<?php

/**
 * 类自动加载函数
 */
function autoload($class)
{
    //$class = system\utils\String
    $classpath = CLASSPATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classpath))
        require $classpath;
    else {
        throw new Exception('Class Not Found. ' . $class);
    }
}

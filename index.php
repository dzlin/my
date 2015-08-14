<?php

require 'definds.php';

//echo PATH_ROOT;

//$app = include CONFIG_DIR . '/common.php';
//var_dump($app);

$str = "fsdfsdfsd;fds'fsd<fsd";
echo \system\utils\Strings::filterXss($str);
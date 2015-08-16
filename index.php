<?php
//引入必须包含的定义文件
require 'init.php';

//其他需要引入的文件
//设置页面标题
$pageTitle = '首页';


//在这里写当前页面的业务逻辑代码
?>
<!DOCTYPE html>
<html lang="zh_CN">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>
        <?php //公共css样式文件  ?>
        <link rel="stylesheet" href="./static/css/common.css">
        <script src="./static/js/common.js"></script>
        <?php //需要初始化的js变量     ?>
    </head>
    <body>
        <?php //php数据输出 ?>
        <h1>Welcome!</h1>
        <a href="./web/login.php">登陆</a>
    </body>
    <?php //有的页面不需要jquery的就去掉  ?>
    <script src="./static/js/jquery.min.js"></script>
    <script src="./static/js/index.js"></script>
</html>
<?php
//可能需要做一些提交后的处理
echo microtime(true) - START_TIME;
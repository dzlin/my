<?php
/*
 * 引入必须包含的定义文件
 */
require '../init.php';

use system\utils\String;
use system\utils\Web;
use module\user\model\UserModel;

/**
 * 登陆处理
 * email,password
 */
if (isset($_POST['submit']) && Web::isPost()) {
    
    /**
     * 检查post数据
     */
    $fields = array(
        'email',
        'password'
    );
    if (true !== Web::checkPostData($fields))
        Web::echo404('login checkPostData');
    
    /**
     * 检查email和password（8-32，大小写字母，数字）
     */
    if (! String::isEmail($_POST['email']))
        Web::echo404('login isEmail');
    if (! String::isPassword($_POST['password']))
        Web::echo404('login isPassword');
    
    /**
     * 检查登陆，匹配密码
     */
    $userModel = new UserModel();
    $bool = $userModel->userLogin($_POST['email'], $_POST['password']);
    if ($bool) {
        echo 'login success';
    } else {
        echo 'login failed';
    }
}
die;
// 其他需要引入的文件
// 设置页面标题
$pageTitle = '登陆';
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
<meta charset="UTF-8">
<title><?php echo $pageTitle; ?></title>
		<?php //公共css样式文件             ?>
        <link rel="stylesheet" href="../static/css/common.css">
		<?php //其他需要引入的css文件和js文件          ?>
        <script src="../static/js/common.js"></script>
		<?php //需要初始化的js变量             ?>
    </head>
<body>
		<?php //php数据输出            ?>
        <h3>登陆页面</h3>

</body>
	<?php //有的页面不需要jquery的就去掉            ?>
    <script src="../static/js/jquery.min.js"></script>
<script src="../static/js/login.js"></script>
	<?php //其他的js文件             ?>
</html>
<?php
//可能需要做一些提交后的处理


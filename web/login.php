<?php
/*
 * 引入必须包含的定义文件
 */
require '../init.php';

use system\db\Pdo;
use system\core\Config;
use system\utils\String;
use system\utils\Web;
use system\core\Redis as IRedis;

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
     * 加载数据库配置文件
     */
    $config = new Config(CONFIG_DIR);
    $dbConfig = $config['db'];
    
    /**
     * 数据库pdo连接dsn
     */
    $dsn = 'mysql:host=' . $dbConfig['host'];
    $dsn .= ';port=' . $dbConfig['port'];
    $dsn .= ';dbname=' . $dbConfig['name'];
    $dsn .= ';charset=' . $dbConfig['charset'];
    
    /**
     * 获取连接实例
     */
    $pdo = new Pdo($dsn, $dbConfig['user'], $dbConfig['pass']);
    
    /**
     * 连接数据库
     */
    $pdo->connect();
    
    /**
     * sql查询语句 根据email获取登录密码和salt
     */
    $sql = 'select `password` pwd, `salt` scode,';
    $sql .= '`uid` from dzlin_user where `email` = :email';
    $data = array(
        ':email' => $_POST['email']
    );
    
    /**
     * 查询没有数据返回false
     */
    $user = $pdo->findOne($sql, $data);
    if ($user) {
        echo json_encode($user);
    }
    /**
     * 登陆成功后Session保存uid
     */
    $_SESSION['uid'] = $user['uid'];
    
    /**
     * redis保存用户数据
     * 1.加载redis配置
     * 2.实例化redis工具类
     * 3.设置值
     */
    $rdConfig = $config['redis'];
    
    /**
     * redis缓存数据
     * pwd不缓存
     */
    unset($user['pwd']);
    $redis = new IRedis($rdConfig['host'], $rdConfig['port']);
    $res = $redis->set($rdConfig['userPrefix'] . $user['uid'], $user);
    var_dump($res);
    /*
     * $rd = new \Redis();
     * $rd->connect($redisConfig['host'], $redisConfig['port']);
     * $keys = $rd->keys('u*');
     * var_dump($keys);
     */
    $redis->get('u1', $return);
    var_dump($return);
    
    die();
}

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


<?php
use system\utils\Web;
use module\user\model\UserModel;
use module\user\dao\User;
use system\core\UserUtil;
use system\utils\String;

// 必须引入的文件
require '../init.php';

/**
 * email,password
 */
if (isset($_POST['submit']) && Web::isPost()) {
    /**
     * TODO 做数据检查过滤
     * .是否提交数据
     * .email是否符合格式
     * .password是否符合格式
     * .email是否真实有效
     * .email是否注册过
     */
    
    $fileds = array(
        'email',
        'password'
    );
    if (true !== Web::checkPostData($fileds)) {
        Web::echo404('register');
    }
    
    if (! String::isEmail($_POST['email'])) {
        Web::echo404('register email');
    }
    
    if (! String::isPassword($_POST['password'])) {
        Web::echo404('register password');
    }
    
    // user模型
    $userModel = new UserModel();
    
    if ($userModel->hasEmail($_POST['email'])) {
        Web::echo404('register has email ' . $_POST['email']);
    }
    
    // 填充用户数据
    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setSalt(String::randSalt());
    $user->setPassword(UserUtil::enPassword($_POST['password'], $user->getSalt()));
    $user->setRegisterTime(START_TIME);
    $user->setLastLoginTime(START_TIME);
    
    // 创建用户
    $aid = $userModel->createUser($user);
    var_dump($aid);
} else {
    echo 'register';
}

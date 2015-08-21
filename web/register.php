<?php
use system\utils\Web;
use module\user\model\UserModel;
use module\user\dao\User;
use system\core\UserUtil;
use system\utils\String;

echo memory_get_usage(true) . '==';

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
    /**
     * 写注册信息到数据表
     */
    
    // user模型
    $userModel = new UserModel();
    
    // 设置用户数据
    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setSalt(String::randSalt());
    $user->setPassword(UserUtil::enPassword($_POST['password'], $user->getSalt()));
    $user->setRegisterTime(START_TIME);
    $user->setLastLoginTime(START_TIME);
    
    // 创建用户
    $aid = $userModel->createUser($user);
    var_dump($aid);
    echo '==' . memory_get_usage(true);
} else {
    echo 'register';
}

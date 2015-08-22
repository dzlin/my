<?php
namespace module\user\model;

use module\common\model\Model;
use module\user\dao\User;

/**
 * 用户模型
 *
 * @author zhanglin
 *        
 */
class UserModel extends Model
{

    /**
     * 数据表名
     *
     * @var stirng
     */
    protected $table = 'iyou_user';

    /**
     * 检查邮箱是否已经注册过
     *
     * @param string $email            
     * @return boolean 注册过返回true，否则返回false
     */
    public function hasEmail($email)
    {
        $sql = 'select `aid` from `' . $this->table . '` where `email` = :email';
        $data = array(
            ':email' => $email
        );
        $result = $this->pdo->findOne($sql, $data);
        if ($result)
            return true;
        return false;
    }

    /**
     * 创建用户（注册）
     *
     * @param User $user            
     * @return mixed 成功返回uid
     */
    public function createUser(User $user)
    {
        $sql = 'insert into `' . $this->table . '` (`email`,`password`,`registerTime`,';
        $sql .= '`lastLoginTime`,`salt`)values(:email,:password,:registerTime,';
        $sql .= ':lastLoginTime,:salt)';
        $data = array(
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':registerTime' => $user->getRegisterTime(),
            ':lastLoginTime' => $user->getLastLoginTime(),
            ':salt' => $user->getSalt()
        );
        return $this->pdo->add($sql, $data);
    }
}
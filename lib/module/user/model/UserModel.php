<?php
namespace module\user\model;

use module\common\model\Model;
use module\user\dao\User;
use system\core\UserUtil;
use module\common\model\PermissionModel;

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
     * 检查用户登录
     *
     * @param string $email            
     * @param stirng $password            
     * @return mixed|boolean
     */
    public function userLogin($email, $password)
    {
        $sql = 'select `uid`,`password`,`salt`,`username`,`registerTime` `regtime`,';
        $sql .= '`lastLoginTime` `logtime`,`state`,`aid` from `' . $this->table . '` ';
        $sql .= 'where `email` = :email';
        $data = array(
            ':email' => $email
        );
        $user = $this->pdo->findOne($sql, $data);
        if ($user && $user['state'] == 0) {
            $password = UserUtil::enPassword($password, $user['salt']);
            if ($user['password'] == $password) {
                // TODO 用户登录成功后做一些记录（数据库和缓存）
                $permissionModel = new PermissionModel();
                $permissions = $permissionModel->getPermission($user['uid']);
                var_dump($permissions);
                return $user;
            }
        }
        return false;
    }

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
     * <p>触发器自动向user_role和user_user_group添加数据</p>
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
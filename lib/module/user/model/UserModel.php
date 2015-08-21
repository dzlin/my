<?php
namespace module\user\model;

use module\common\model\Model;
use module\user\dao\User;

class UserModel extends Model
{

    protected $table = 'iyou_user';

    public function createUser(User $user)
    {
        $this->pdo->connect();
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
<?php
namespace module\common\model;

class PermissionModel extends Model
{

    protected $table = 'iyou_operation';

    /**
     * 权限检查sql
     *
     * @var string
     */
    private $sql = 'select o.`code` from iyou_user_role ur
            left join iyou_user_user_group uug on ur.uid = uug.uid
            left join iyou_user_group_role ugr on uug.gid = ugr.gid
            left join iyou_role_operation ro on ur.rid = ro.rid or ugr.rid = ro.rid
            left join iyou_operation o on ro.oid = o.oid
            where ur.uid = :uid';

    public function addPermission($operation, $code, $pid = 0)
    {
        $sql = 'insert into `' . $this->table . '`(`operation`,`code`,`pid`)values';
        $sql .= '(:operation,:code,:pid)';
        $data = array(
            ':operation' => $operation,
            ':code' => $code,
            ':pid' => $pid
        );
        return $this->pdo->add($sql, $data);
    }

    /**
     * 获取所有的权限操作
     *
     * @return mixed
     */
    public function getAllPermission()
    {
        $sql = 'select * from `' . $this->table . '`';
        return $this->pdo->find($sql);
    }

    /**
     * 权限检查
     *
     * @param integer $uid
     *            用户ID
     * @param string $ocode
     *            操作编码
     * @return boolean 具有权限返回true，否则返回false
     */
    public function checkPermission($uid, $ocode)
    {
        $sql = $this->sql . ' and o.`code` = :ocode';
        $data = array(
            ':uid' => $uid,
            ':ocode' => $ocode
        );
        $result = $this->pdo->findOne($sql, $data);
        if ($result && ! empty($result))
            return true;
        return false;
    }

    /**
     * 获取权限操作码
     *
     * @param integer $uid
     *            用户ID
     * @return array 该用户所拥有的操作权限
     */
    public function getPermission($uid)
    {
        $data = array(
            ':uid' => $uid
        );
        return $this->pdo->find($this->sql, $data);
    }
}

<?php

namespace system\db;

/**
 * PDO驱动类
 * @author dzlin 
 * @datetime 2015-8-15  15:29:32
 */
class Pdo
{

    /**
     * PDOStatement
     * 
     * @var PDOStatement $PDOStatement
     */
    protected $PDOStatement = null;

    /**
     * PDO连接资源
     * 
     * @var \PDO $db;
     */
    private $db;

    /**
     * 当前类实例
     * 
     * @var \db\Pdo $instance
     */
    public static $instance = null;

    /**
     * pdo 连接DSN
     * @var string $dsn
     */
    private $dsn = null;

    /**
     * 数据库用户名
     * @var string $user
     */
    private $user = null;

    /**
     * 登陆密码
     * @var string $pssword 
     */
    private $pass = null;

    /**
     * PDO连接选项
     * @var array $options
     */
    private $options = array();

    /**
     * 
     * @param string $dsn
     * @param string $user
     * @param string $pass
     * @param array $options PDO连接选项
     */
    private function __construct(string $dsn, string $user, string $pass,
            $options = array())
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->pass = $pass;
        $this->options = $options;
    }

    //mysql:host=127.0.0.1;port=3306;dbname=anexis_new;charset=UTF8;
    //$dsn = 'mysql:host=' . $d['host'];
    //$dsn .= ';port=' . $d['port'];
    //$dsn .= ';dbname=' . $d['name'];
    //$dsn .= ';charset=' . $d['charset'];

    /**
     * 数据库连接
     * @throws \Exception
     */
    public function connect()
    {
        try {
            $this->db = new \PDO($this->dsn, $this->user, $this->pass,
                    $this->options);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 获取连接实例
     * @param type $d
     * @return type \db\Pdo;
     */

    /**
     * 获取实例
     * 
     * DSN格式
     * mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8;
     * 
     * @param string $dsn PDO DSN
     * @param string $user 数据库用户名
     * @param string $pass 登陆密码
     * @param array $options PDO选项
     * @return \db\Pdo Pdo实例
     */
    public static function
    getInstance(string $dsn, string $user, string $pass, $options = array())
    {
        if (!self::$instance instanceof self) {
            self::$instance = new Pdo($dsn, $user, $pass, $options);
            return self::

                    $instance;
        }
        return self::$instance;
    }

    /**
     * 向数据库插入数据，返回受影响的行数
     *
     * @param string $sql
     * @param array $data
     * @return mixed
     */
    public function add($sql, $data)
    {
        $this->query($sql, $data);
        return $this->db->lastInsertId();
    }

    /**
     * 向数据库更新数据，返回受影响的行数
     *
     * @param string $sql
     * @param array $data
     * @return mixed
     */ public function update($sql, $data)
    {
        $result = $this->query($sql, $data);
        return $result->rowCount();
    }

    /**
     * 向数据库查询数据，返回结果集
     *
     * @param string $sql
     * @param array $data
     * @return mixed
     */ public function findOne($sql, $data)
    {
        $result = $this->query($sql, $data);
        return $result->fetch();
    }

    /**
     * 向数据库查询数据，返回结果集
     *
     * @param string $sql
     * @param array $data
     * @return mixed
     */
    public function find($sql, $data = array())
    {
        $result = $this->query($sql, $data);
        return $result->fetchAll();
    }

    /**
     * 删除数据，返回布尔值
     *
     * @param string $sql
     * @param array $data
     * @return boolean
     */
    public function remove($sql, $data)
    {
        $result = $this->query($sql, $data);
        if ($result)
            return true;
        return false;
    }

    /**
     * 
     * @param string $sql 要执行的sql语句
     * @param array $data 要绑定参数（可选）
     * @return type
     * @throws \Exception
     */
    private function query($sql, $data = array())
    {
        try {
            $rst = $this->db->prepare($sql);
            foreach ($data as $key => &$value) {
                if (preg_match("/(_int)$/", $key) || is_numeric($key)) {
                    $rst->bindParam($key, $value, \PDO::PARAM_INT);
                } else {
                    $rst->bindParam($key, $value, \PDO::PARAM_STR);
                }
            }
            $rst->setFetchMode(\PDO::FETCH_ASSOC);
            $rst->execute();

            $errorInfo = $rst->errorInfo();
            if ($errorInfo[2]) {
                $errInfo = $rst->errorInfo();
                throw new \Exception($errInfo[2]);
            }
            return $rst;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 开始一个事务
     */
    public function beginTransaction()
    {

        $this->db->beginTransaction();
    }

    /**
     * 事务提交
     */
    public function commit()
    {
        $this->db->commit();
    }

    /**
     * 事务回滚
     */
    public function rollBack()
    {
        $this->db->rollBack();
    }

    /**
     * 释放资源
     */
    public function __destruct()
    {
        $this->db = null;
    }

    /**
     * 执行原生sql语句，返回关联结果集
     * 
     * @param string $sql
     */
    public function sqlQuery($sql)
    {
        $result = $this->db->query($sql, \PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

}

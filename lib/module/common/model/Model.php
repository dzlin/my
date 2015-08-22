<?php
namespace module\common\model;

use system\core\Config;
use system\db\Pdo;

/**
 * 公共模型类
 *
 * 所有数据表的模型类都要继承
 *
 * @author zhanglin
 *        
 */
class Model
{

    /**
     * PDO 实例
     *
     * @var system\db\PDO
     */
    protected $pdo;

    /**
     * 父类构造函数中自动实例化PDO
     * 好让子类直接使用
     */
    public function __construct()
    {
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
        $this->pdo = new Pdo($dsn, $dbConfig['user'], $dbConfig['pass']);
        $this->pdo->connect();
    }
}
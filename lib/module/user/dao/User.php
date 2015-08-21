<?php
namespace module\user\dao;

/**
 * 用户模型
 *
 * @author zhanglin
 *        
 */
class User
{

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRegisterTime()
    {
        return $this->registerTime;
    }

    public function setRegisterTime($registerTime)
    {
        $this->registerTime = $registerTime;
    }

    /**
     * 用户ID
     *
     * @var integer
     */
    private $uid;

    /**
     * 用户名
     *
     * @var string
     */
    private $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    private $email;

    private $password;

    private $registerTime;

    private $lastLoginTime;

    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
    }

    public function setLastLoginTime($lastLoginTime)
    {
        $this->lastLoginTime = $lastLoginTime;
    }

    private $aid;

    public function getAid()
    {
        return $this->aid;
    }

    public function setAid($aid)
    {
        $this->aid = $aid;
    }

    private $state;

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    private $salt;

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUid()
    {
        return $this->aid;
    }

    public function setUid($uid)
    {
        // if (! is_int($uid))
        // throw new \Exception('Invalid parameter');
        $this->aid = $uid;
    }
}
<?php
namespace User;

class User implements UserI{

    private $_id,
        $_username,
        $_email,
        $_password,
        $_group_id,
        $_created_at,
        $_updated_at,
        $_img,
        $_token;

    public function __construct()
    {
//        $this->_id = $id;
//        $this->_username = $_username;
//        $this->_email = $_email;
//        $this->_password = $_password;
//        $this->_group_id = $_group_id;
//        $this->_created_at = $_created_at;
//        $this->_updated_at = $_updated_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->_group_id;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->_group_id = $group_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->_updated_at = $updated_at;
    }
    public function setImg($img){
        $this->_img = $img;
    }
    public function getImg(){
        return $this->_img;
    }
    public function setToken($token){
        $this->_token = $token;
    }
    public function getToken(){
        return $this->_token;
    }
}
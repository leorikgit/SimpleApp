<?php
namespace User;
class UserQuery implements UserQueryI{

    private $_userMapper;



    public function __construct(UserMapperI $userMapper)
    {
        $this->_userMapper = $userMapper;

    }

    public function findByEmail($email)
    {
        $sql = "SELECT u.id, u.password, g.name FROM users u LEFT JOIN groups g ON u.group_id=g.id WHERE email=?";
        return  $this->_userMapper->query($sql, TRUE, array($email));

    }
    public function findById($id){
        try {
            $sql = "SELECT * FROM users WHERE id=?";
            return $userData = $this->_userMapper->query($sql, TRUE, array($id));
        }catch(\Exception $e){
            echo 'Exception occured: '.$e->getCode().' :'.$e->getMessage();
        }
        $sql = "SELECT * FROM users WHERE id=?";
        return $this->_userMapper->query($sql, TRUE, array($id));
    }

}


<?php
namespace  User;

use Database\DatabaseI;

Class UserRepository implements UserRepositoryI{

    private $_db;

    public function __construct(DatabaseI $source)
    {
        $this->_db = $source;
    }

    public function save(UserI $user)
    {
        // TODO: Implement save() method.
    }
    public function find($id)
    {
        $data = $this->_db->findById($id, 'users');
        $userFactory = new UserFactory($this->_db);
        if(!$data){
            return false;
        }
        return $userFactory->createUser($data);
    }
    public function remove(UserI $user)
    {
        // TODO: Implement remove() method.
    }
}

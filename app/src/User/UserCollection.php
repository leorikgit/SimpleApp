<?php
namespace User;
class UserCollection implements UserCollectionI{
    private $_users = [];

    public function push(User $user){
        $this->_users[] = $user;
        return $this;
    }
    public function all()
    {
        return $this->_users;
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->_users);
    }

}
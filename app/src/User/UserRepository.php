<?php
namespace User;

class UserRepository implements UserRepositoryI{

    private $_userMapper,
            $_userFactory;
    public function __construct(UserMapperI $userMapper, UserFactory $userFactory)
    {
        $this->_userMapper = $userMapper;
        $this->_userFactory = $userFactory;
    }

    public function find($id)
    {
        $userData = $this->_userMapper->find($id);
        return $this->_userFactory->createUser($userData);
    }
    public function save(UserI $user)
    {
        $data = [];
        $data['id'] = $user->getId();
        $data['username'] = $user->getUsername();
        $data['password'] = $user->getPassword();
        $data['email'] = $user->getEmail();
        $data['group_id'] = $user->getGroupId();
        $data['img'] = $user->getImg();
        $data['token'] = $user->getToken();
        $data['created_at'] = $user->getCreatedAt();
        $data['updated_at'] = $user->getUpdatedAt();
        if($data['id']){
            return $this->update($data);
        }else{
            return $this->create($data);
        }
    }
    public function remove(UserI $user)
    {
        // TODO: Implement remove() method.
    }
    public function create($data){
        return $this->_userMapper->create($data);
    }
}

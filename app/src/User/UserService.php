<?php
namespace User;
use Config\Config;
use Group\GroupMapper;
use Hash\Hash;
use Session\Session;


class UserService implements UserServiceI{
    private $_userQuery,
            $_userRepository,
            $_isLogin = false,
            $_userFactory,
            $_groupMapper,
            $_user;

    public function __construct(UserRepositoryI $userRespository, UserQueryI $userQuery, UserFactory $userFactory, GroupMapper $groupMapper)
    {
        $this->_userQuery = $userQuery;
        $this->_userRepository = $userRespository;
        $this->_userFactory = $userFactory;
        $this->_groupMapper = $groupMapper;
        $this->loggedUser();
    }
    public function loggedUser(){
        $sessionName =  Config::get('session/session_name');
        if(Session::exist($sessionName)){
            $userId = Session::get($sessionName);
            $user = $this->_userRepository->find($userId);
            if($user){
                $this->_user = $user;
                $this->_isLogin = true;
            }
        }
    }

    public function isLogin()
    {
        return $this->_isLogin;
    }
    public function hasPermission($key){
        if(!$this->_user){
            return false;
        }
        $groupData = $this->_groupMapper->find($this->_user->getId());
        $permissions = json_decode($groupData['permissions'], true);
        if(!$permissions[$key] ==true) {
            return false;
        }

        return true;
    }

    public function login($email, $password)
    {
        $result =  $this->_userQuery->findByEmail($email);

        if(!$result){
            return false;
        }

        $this->_user  = $this->_userRepository->find($result['id']);
        $HashPassword = $this->_user->getPassword();

        if(!$this->_checkCredentials($password, $HashPassword)) {
            return false;
        }

        $sessionName = Config::get('session/session_name');
        Session::put($sessionName, $this->_user->getId());
        return $this->_isLogin = true;


    }
    public function logout(){
        $sessionName = Config::get('session/session_name');
        $this->_user = false;
        if(Session::exist($sessionName)){
            Session::delete($sessionName);
        }
    }
    public function register($data)
    {
        $data['group_id'] = 1;
        $now = new \DateTime();
        $now = $now->format('Y-m-d');

        $data['created_at'] = $now;
        $data['updated_at'] = null;
        $data['password'] = $hashPassword = Hash::generate($data['password']);

        $user = $this->_userFactory->createUser($data);
        if($this->_userRepository->save($user)){
           return true;
        }
        return false;

    }
    public function getUser(){
        if(!$this->_user) {
            return false;
        }
        return $this->_user;
    }
    private function _checkCredentials($password, $HashPassword){

        if(HAsh::verify($password, $HashPassword)){
            return true;
        }
        return false;
    }
}
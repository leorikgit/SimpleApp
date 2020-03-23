<?php
namespace User;

use Database\DatabaseI;
use Config\Config;
use Session\Session;

Class UserService{
    private $_db,
            $_user,
            $_session_name,
            $_isLogin = false;


    public function __construct(DatabaseI $source)
    {
        $this->_db = $source;
        $this->_user = $user;
        $this->_session_name = Config::get('session/session_name');
        $this->checkIfLogin();
    }
    private function checkIfLogin(){
        if(Session::exist($this->_session_name)){
            $session_name = Session::get($this->_session_name);
            if($session_name == $this->_user->id){
                $this->_isLogin = true;
            }
        }
    }
    public function isLogin(){
        return $this->_isLogin;
    }
}
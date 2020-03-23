<?php
namespace User;
interface UserServiceI{
    public function isLogin();
    public function login($email, $password);
    public function register($data);
    public function getUser();
}
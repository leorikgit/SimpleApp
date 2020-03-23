<?php
namespace Hash;
class Hash implements HashI{


    public  static function generate($hashedPassword){
        return password_hash($hashedPassword, PASSWORD_DEFAULT);
    }
    public  static function verify($password, $hashedPassword){
        if(password_verify($password, $hashedPassword)) {
            return true;
        }
        return false;
    }

}
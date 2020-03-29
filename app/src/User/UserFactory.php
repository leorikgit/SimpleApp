<?php
namespace User;

use Database\DatabaseI;

Class UserFactory implements UserFactoryI{

    public function createUser($data)
    {

        $user = null;
        switch ($data['group_id']){
            case 1:

                $user =  $this->newUser($data);
                break;
            case 2:
                $user = new Moderator();
                break;
            case 3:
                $user = new Administrator();
                break;

        }
        return $user;
    }
    private function newUser($data){

        $user = new User();
        if(isset($data['id'])){
            $user->setId($data['id']);
        }
        $data['group_id'] = 1;


        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setGroupId($data['group_id']);

        $user->setCreatedAt($data['created_at']);
        $user->setUpdatedAt($data['updated_at']);
        return $user;

    }

}
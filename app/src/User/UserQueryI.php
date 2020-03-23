<?php
namespace User;
interface UserQueryI{
    public function findByEmail($email);
    public function findById($id);
}

<?php
namespace User;
interface UserRepositoryI{
    public function find($id);
    public function save(UserI $user);
    public function remove(UserI $user);
}
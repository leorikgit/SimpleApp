<?php
namespace User;
interface UserCollectionI{
    public function push(User $user);
    public function all();
    public function getIterator();
}
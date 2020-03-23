<?php
namespace User;

interface UserI{
    public function setId($id);
    public function getId();
    public function setUsername($username);
    public function getUsername();
    public function setEmail($email);
    public function getEmail();
    public function setPassword($password);
    public function getPassword();
    public function setGroupId($groupId);
    public function getGroupId();
    public function setCreatedAt($created_at);
    public function getCreatedAt();
    public function setUpdatedAt($updated_at);
    public function getUpdatedAt();

}

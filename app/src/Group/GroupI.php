<?php
namespace Group;

interface GroupI{
    public function getId();
    public function setId($id);
    public function getName();
    public function setName($name);
    public function getPremission();
    public function setPremission($premission);
    public function getCreatedAt();
    public function setCreatedAt($created_at);
    public function getUpdatedAt();
    public function setUpdatedAt($updated_at);
}
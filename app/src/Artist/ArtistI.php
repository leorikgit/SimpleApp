<?php
namespace Artist;
interface ArtistI{
    public function setId($id);
    public function getId();
    public function setName($name);
    public function getName();
    public function setCreatedAt($created_at);
    public function getCreatedAt();
    public function setUpdatedAt($updated_at);
    public function getUpdatedAt();
}

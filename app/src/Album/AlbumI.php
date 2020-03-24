<?php
namespace Album;
interface AlbumI{
    public function setId($id);
    public function getId();
    public function setTitle($title);
    public function getTitle();
    public function setArtist($artist);
    public function getArtist();
    public function setArtWorkPath($path);
    public function getArtWorkPath();
    public function setCreatedAt($created_at);
    public function getCreatedAt();
    public function setUpdatedAt($updated_at);
    public function getUpdatedAt();
}
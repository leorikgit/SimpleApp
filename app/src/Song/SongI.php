<?php
namespace Song;
interface SongI{
    public function setId($id);
    public function getId();
    public function setTitle($title);
    public function getTitle();
    public function setArtist($artist);
    public function getArtist();
    public function setGenre($genre);
    public function getGenre();
    public function setDuration($duration);
    public function getDuration();
    public function setPath($path);
    public function getPath();
    public function setAlbumOrder($albumOrder);
    public function getAlbumOrder();
    public function setPlayCount($playCount);
    public function getPlayCount();
    public function setCreatedAt($created_at);
    public function getCreatedAt();
    public function setUpdatedAt($updated_at);
    public function getUpdatedAt();

}

<?php
namespace PlaylistSong;
interface PlaylistSongI{
    public function setId($id);
    public function getId();
    public function setPlaylistId($playlistId);
    public function getPlaylistId();
    public function setSongId($id);
    public function getSongId();
    public function setSongOrder($songOrder);
    public function getSongOrder();
    public function setCreatedAt($created_at);
    public function getCreatedAt();
    public function setUpdatedAt($updated_at);
    public function getUpdatedAt();
}
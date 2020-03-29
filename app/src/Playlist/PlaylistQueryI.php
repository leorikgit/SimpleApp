<?php
namespace Playlist;
interface PlaylistQueryI{
    public function getOwnerPlaylistById($data);
    public function findPlaylistByName($name);

}
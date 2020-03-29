<?php
namespace PlaylistSong;
interface PlaylistSongQueryI{
    public function findSongsByPlaylistId($id);
    public function findSongsMaxOrderByPlaylistId($id);
}
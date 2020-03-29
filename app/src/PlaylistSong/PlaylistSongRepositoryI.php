<?php
namespace PlaylistSong;
interface PlaylistSongRepositoryI{
    public function save(PlaylistSongI $playlistSong);
    public function find($id);
    public function remove(PlaylistSongI $playlistSong);

}
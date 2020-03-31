<?php
namespace PlaylistSong;
interface PlaylistSongRepositoryI{
    public function save(PlaylistSongI $playlistSong);
    public function find($id);
    public function delete(PlaylistSongI $playlistSong);

}
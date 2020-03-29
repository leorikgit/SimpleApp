<?php
namespace Song;
interface SongQueryI{
    public function getById($id);
    public function findAllAlbumSongsByID($id);
    public function findTenRandomSongs();
    public function findAllSongsBySearch($search);
    public function findAllSongsByPlaylistId($id);
}
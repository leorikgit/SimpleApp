<?php
namespace Song;
interface SongQueryI{
    public function getById($id);
    public function findAllAlbumSongsByID();
}
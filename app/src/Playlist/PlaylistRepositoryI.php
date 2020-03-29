<?php
namespace Playlist;
interface PlaylistRepositoryI{
    public function find($id);
    public function save(PlaylistI $user);
    public function remove(PlaylistI $user);
}
<?php
namespace Playlist;
interface PlaylistCollectionI{
    public function push(PlaylistI $playlist);
    public function all();
    public function getIterator();
}
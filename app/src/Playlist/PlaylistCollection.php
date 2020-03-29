<?php
namespace Playlist;


class PlaylistCollection implements PlaylistCollectionI{

    private $_playlists = [];

    public function push(PlaylistI $playlist)
    {
        $this->_playlists[] = $playlist;
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->_playlists);
    }
    public function all()
    {
        return $this->_playlists;
    }

}
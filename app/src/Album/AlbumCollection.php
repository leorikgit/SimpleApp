<?php
namespace Album;
class AlbumCollection implements AlbumCollectionI{
    private $_albums = [];

    public function push(AlbumI $album)
    {
        $this->_albums[] = $album;
    }
    public function all()
    {
        return $this->_albums;
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->_albums);
    }
}
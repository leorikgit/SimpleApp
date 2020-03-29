<?php
namespace Artist;
class ArtistCollection implements ArtistCollectionI {
    private $_artists;

    public function push(ArtistI $artist)
    {
        $this->_artists[] = $artist;
    }
    public function all()
    {
        return $this->_artists;
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->_artists);
    }
}

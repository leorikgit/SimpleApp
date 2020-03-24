<?php
namespace Song;
class SongCollection implements SongCollectionI{
    private $_songs = [];

    public function push(SongI $song){
        $this->_songs[] = $song;
        return $this;
    }
    public function all()
    {
        return $this->_songs;
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->_songs);
    }

}
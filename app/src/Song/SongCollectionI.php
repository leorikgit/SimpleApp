<?php
namespace Song;
interface SongCollectionI{
    public function push(SongI $song);
    public function all();
    public function getIterator();
}
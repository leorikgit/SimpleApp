<?php
namespace Artist;
interface ArtistCollectionI{
    public function push(ArtistI $artist);
    public function all();
    public function getIterator();
}
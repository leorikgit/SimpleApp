<?php
namespace Album;
interface AlbumCollectionI{
    public function push(AlbumI $album);
    public function all();
    public function getIterator();
}
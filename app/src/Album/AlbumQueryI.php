<?php
namespace Album;
interface AlbumQueryI{
    public function getById($id);
    public function findAll();
    public function getAlbumsByArtist($id);
    public function findAllByName($name);
}
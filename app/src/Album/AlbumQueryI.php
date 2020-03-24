<?php
namespace Album;
interface AlbumQueryI{
    public function getById($id);
    public function findAll();
}
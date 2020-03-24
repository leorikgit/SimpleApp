<?php
namespace Album;
interface AlbumMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}
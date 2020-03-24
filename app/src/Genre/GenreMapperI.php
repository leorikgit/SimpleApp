<?php
namespace Genre;
interface GenreMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}

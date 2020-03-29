<?php
namespace Artist;
interface ArtistMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}

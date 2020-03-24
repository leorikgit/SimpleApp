<?php
namespace Song;
interface SongMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}

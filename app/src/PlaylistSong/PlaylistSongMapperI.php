<?php
namespace PlaylistSong;
interface PlaylistSongMapperI{
public function find();
public function query($sql, $one, $params);
public function create($params);
}

<?php
namespace PlaylistSong;
interface PlaylistSongMapperI{
public function find($id);
public function query($sql, $one, $params);
public function create($params);
public function delete($id);
}

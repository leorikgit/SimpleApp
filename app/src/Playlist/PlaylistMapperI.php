<?php
namespace Playlist;
interface PlaylistMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
    public function delete($id);
}
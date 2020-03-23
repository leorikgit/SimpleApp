<?php
namespace Group;
interface GroupMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}

<?php
namespace User;
interface UserMapperI{
    public function find($id);
    public function query($sql, $one, $params);
    public function create($data);
}

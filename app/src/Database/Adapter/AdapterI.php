<?php
namespace Database\Adapter;
interface AdapterI{
    public function find($sql, $id);
    public function insert($sql, $params);
    public function update();
    public function delete();
    public function query($sql, $params);
    public function getError();

}
<?php
namespace  Database;

interface DatabaseI{

    public function find($id, $table, $param);
    public function findById($id, $table);
    public function fetch($sql, $table, $fields);
    public function create($table, $fields);
    public function update($table, $params);
    public function delete($id);


}
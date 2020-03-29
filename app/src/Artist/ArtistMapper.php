<?php
namespace Artist;
use Database\Adapter\AdapterI;

class ArtistMapper implements ArtistMapperI {
    private $_adapter;
    public function __construct(AdapterI $adapter)
    {
        $this->_adapter = $adapter;
    }

    public function query($sql, $one, $params)
    {
        $result =  $this->_adapter->query($sql, $params);
        if($one){
            return $result =  $this->_adapter->query($sql, $params)->getResult();
        }
        return $this->_adapter->query($sql, $params)->getResults();
    }
    public function create($data)
    {
        // TODO: Implement create() method.
    }
    public function find($id)
    {
        return $this->_adapter->find("SELECT * FROM artists WHERE id=?", $id);
    }
}
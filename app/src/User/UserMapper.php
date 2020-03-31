<?php
namespace User;
use Database\Adapter\AdapterI;
class UserMapper implements UserMapperI{
    private $_adapter;


    public function __construct(AdapterI $adapter)
    {
        $this->_adapter = $adapter;
    }

    public function find($param)
    {
        $sql = "SELECT * FROM users WHERE ".$param."=?";
        return $this->_adapter->find($sql, $param);
    }
    public function query($sql, $one, $params){
        $result =  $this->_adapter->query($sql, $params);

        if($result->getError()){
            throw new \Exception('Something goes wrong');
        }
        if($one){
            return $result =  $this->_adapter->query($sql, $params)->getResult();
        }
        return $this->_adapter->query($sql, $params)->getResults();
    }
    public function create($params){

        return $this->_adapter->insert('users', $params);
    }
    public function update($params){
        return $this->_adapter->update('users', $params);
    }
}

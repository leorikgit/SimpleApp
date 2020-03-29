<?php
namespace Database\Adapter;
use Database\Connection\PDO;
class PdoAdapter implements AdapterI{
    private $_PDO,
            $_query,
            $_result,
            $_error = false,
            $_count;

    public function __construct(PDO $source)
    {
        $this->_PDO = $source;
    }


    public function find($sql, $params)
    {
        return $this->query($sql, array($params))->getResult();
    }

    public function insert($table, $properties)
    {


        $keys = implode(',',array_keys($properties));
        $counter = 1;
        $values = "";
        foreach ($properties as $property){
            $values .='?';
            if($counter < count($properties)){
                $values .= ',';
                $counter++;
            }
        }
        $sql = "INSERT INTO ".$table." (".$keys.") VALUES ({$values})";
        $this->query($sql, $properties);
        if(!$this->getError() && $this->count() > 0){
            return true;
        }
        return false;
    }
    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete($sql, $id)
    {
        $this->query($sql, $id);
        if(!$this->getError() && $this->count() > 0){
            return true;
        }
        return false;
    }

    public function query($sql, $params = array()){
        $this->_error = false;

        if($this->_query = $this->_PDO->getConn()->prepare($sql)){
            if(count($params)){
                $counter = 1;
                foreach ($params as $param){
                    $this->_query->bindValue($counter, $param);
                    $counter++;
                }
            }
            if($this->_query->execute()) {
                $queryFunction = explode(" ",$sql);
                if($queryFunction[0] == "SELECT") {
                    $this->_result = $this->_query->fetchAll(\PDO::FETCH_ASSOC);
                }
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }

            return $this;
        }
    }
    public function getResult(){
        if(!$this->_result){
            return false;
        }
        return $this->_result[0];
    }
    public function getResults(){
        if(!$this->_result){
            return false;
        }
        return $this->_result;
    }
    public function getError(){
        return $this->_error;
    }
    public function count(){
        return $this->_count;
    }
}

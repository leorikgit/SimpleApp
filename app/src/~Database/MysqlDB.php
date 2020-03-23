<?php
namespace  Database;

use \PDO;
class MysqlDB implements DatabaseI
{
    private $_PDO,
            $_error = false,
            $_query,
            $_result,
            $_host,
            $_dbname,
            $_username,
            $_password;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->_host = $host;
        $this->_dbname = $dbname;
        $this->_username = $username;
        $this->_password = $password;

        $this->connect();
    }
    private function connect(){
        try {
            $dsn = "mysql:host=".$this->_host.";dbname=".$this->_dbname."";
            $user = $this->_username;
            $passwd = $this->_password;

            $this->_PDO = new PDO($dsn, $user, $passwd);
            $this->_PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (PDOException $e) {
            die( 'Connection failed: ' . $e->getMessage());
        }
    }
    public function find($id, $table, $param)
    {
        // TODO: Implement find() method.
    }

    public function findById($id, $table)
    {
        return $this->query("SELECT * FROM ".$table." WHERE id=".$id." ")->getResult();
    }
    public function fetch($sql, $table, $fields)
    {
        // TODO: Implement fetch() method.
    }
    public function create($table, $fields)
    {
        // TODO: Implement create() method.
    }
    public function update($table, $params)
    {
        // TODO: Implement update() method.
    }
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function query($sql, $params = array()){
        $this->_error = false;

        if($this->_query = $this->_PDO->prepare($sql)){
            if(count($params)){
                $counter = 1;
                foreach ($params as $param){
                    $this->_query->bindValue($counter, $param);
                    $counter++;
                }
            }
            if($this->_query->execute()) {

                $this->_result= $this->_query->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $this->_error = true;
            }
            return $this;
        }
    }
    private function getResult(){
        if(!$this->_result){
            return false;
        }
        return $this->_result[0];
    }

}
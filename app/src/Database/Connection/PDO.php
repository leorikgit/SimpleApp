<?php
namespace Database\Connection;

class PDO implements ConnectionI{

    private $_PDO;

    public function __construct($config)
    {
        try {
            $dsn = "mysql:host=".$config['host'].";dbname=".$config['dbname']."";
            $user = $config['username'];
            $passwd = $config['password'];

            $this->_PDO = new \PDO($dsn, $user, $passwd);
            $this->_PDO->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
        } catch (\PDOException $e) {
            die( 'Connection failed: ' . $e->getMessage());
        }
    }
    public function getConn(){
        return $this->_PDO;
    }
}
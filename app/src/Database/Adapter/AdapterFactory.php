<?php
namespace Database\Adapter;
use Database\Adapter\PdoAdapter;
use Database\Connection\PDO;
class AdapterFactory implements AdapterFactoryI{
    private static $_factory;
    private $_db;



    public static function getFactory()
    {
        if(!self::$_factory){
            return self::$_factory = new AdapterFactory();
        }
        return self::$_factory;
    }
    public function getDriver($config)
    {

        if(!$this->_db){

            switch ($config['type']){
                case 'Mysql':

                    $this->_db = new PdoAdapter(new PDO($config));

                    break;
            }

        }

        return $this->_db;
    }
}

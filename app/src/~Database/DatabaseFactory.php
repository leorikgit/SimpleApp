<?php
namespace  Database;
use Config\Config;
class DatabaseFactory implements DatabaseFactoryI
{

    public static function getConnection($dbType = null)
    {

        switch($dbType) {
            case "MySQL":
                $dbobj = new MysqlDB(Config::get('mysql/host'), Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
                break;
            case "Oracle":
                $dbobj = new OracleDB();
                break;
            default:
                $dbobj = new MysqlDB(Config::get('mysql/host'), Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
                break;
        }

        return $dbobj;
    }
}
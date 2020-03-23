<?php
namespace  Database;

interface DatabaseFactoryI
{
    public static function getConnection($dbType);
}
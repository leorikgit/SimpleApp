<?php
namespace Database\Adapter;
use Config\ConfigI;
interface AdapterFactoryI{
    public static function getFactory();
    public function getDriver($config);
}

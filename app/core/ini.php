<?php
ob_start();
session_start();

define("BASE_URL","/");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]. '../');

include_once ROOT_PATH.'functions/sanitaze.php';
include_once ROOT_PATH . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('MYSQL_HOST'),
        'username' => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_PASSWORD'),
        'db' => getenv('MYSQL_DATABASE'),
    ),
    'session' => array(
        'token_name' => 'token',
        'session_name' => 'user'
    ),
    'home_page' => array(
        'title' => 'Home',
    ),
    'login_page' => array(
        'title' => 'login',
    ),
    'register_page' => array(
        'title' => 'Register',
    )

);

spl_autoload_register(function($className) {
    $file = ROOT_PATH ."\\src\\" . $className . '.php';
    $file = str_replace('\\', "/", $file);
    //echo $file;
    if (file_exists($file)) {
        include $file;
    }
});

include_once ROOT_PATH."src/Bootstrap.php";
<?php
namespace Utility;
class Redirect
{
    public static function to($location = null){
        if($location){
            if(is_numeric($location)){
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include_once ROOT_PATH. "includes/errors/404.php";
                        exit;
                    break;
                    case 403:
                        header('HTTP/1.0 403 Forbidden');
                        include_once  ROOT_PATH."includes/errors/403.php";
                        exit;
                }
            }
            header("Location: ".BASE_URL.$location);
            exit();
        }
        die('Redirect is null;');
    }
}
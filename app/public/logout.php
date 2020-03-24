<?php
include_once __DIR__."../../core/ini.php";
use Utility\Redirect;
if($userService->isLogin()){
    $userService->logout();
}

Redirect::to('index.php');

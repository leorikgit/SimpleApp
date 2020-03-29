<?php
include __DIR__ .'../../core/ini.php';
use Utility\Redirect;
use Utility\Input;
use Config\Config;
if(!$userService->isLogin()){
    Redirect::to('login.php');
}

if(Input::exist('HTTP_X_REQUESTED_WITH')) {
    if(!$userService->isLogin()){
        Redirect::to(403);
    }
    include_once ROOT_PATH . "includes/searchContent.php";
    exit();
}



$page_title = Config::get('home_page/title');
include_once ROOT_PATH .'includes/header.php';

include_once ROOT_PATH."includes/mainContainerHeader.php";

include_once ROOT_PATH."includes/searchContent.php" ;

include_once ROOT_PATH."includes/mainContainerFooter.php";

<?php
include_once __DIR__."../../../core/ini.php";
use Utility\Input;

use Utility\Redirect;

if(Input::exist('HTTP_X_REQUESTED_WITH')) {
    if(!$userService->isLogin()){
        Redirect::to(403);
    }

    if(!empty(Input::get('id'))){

        $playlistMapper = new \Playlist\PlaylistMapper($conn);
        $playlistFactory  = new \Playlist\PlaylistFactory();
        $playlistRepository = new \Playlist\PlaylistRepository($playlistMapper, $playlistFactory);

        $playlist = $playlistRepository->find(Input::get('id'));
        if(!$playlist){
            echo json_encode(array('status'=> 0, 'message' => 'Playlist doesnt exist.'));
            exit();
        }
        if($playlist->getOwner() != $userService->getUserId()){
            echo json_encode(array('status'=> 0, 'message' => 'permission denied'));
            exit();
        }

       $result = $playlistRepository->remove($playlist);
        echo json_encode(array('status'=> 1, 'message' => 'all good'));



    }
}
Redirect::to('index.php');


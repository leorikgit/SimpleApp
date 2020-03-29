<?php
include_once __DIR__."../../../core/ini.php";
use Utility\Input;
use Playlist\PlaylistMapper;
use \Playlist\PlaylistFactory;
use \Playlist\PlaylistQuery;
use \Playlist\PlaylistRepository;
use Utility\Redirect;

if(Input::exist('HTTP_X_REQUESTED_WITH')) {
    if(!$userService->isLogin()){
        Redirect::to(403);
    }

    if(!empty(Input::get('name'))){

        $PlaylistFactory = new PlaylistFactory();
        $playlistMapper = new PlaylistMapper($conn);

        $playlistQuery = new PlaylistQuery($playlistMapper);
        $checkUnique = $playlistQuery->findPlaylistByName(Input::get('name'));
        if($checkUnique){
            echo json_encode(array('status'=> 0, 'message' => 'Name already exists'));
            exit();
        }
        $playlistRepository = new PlaylistRepository($playlistMapper);


        $now = new \DateTime();
        $now = $now->format('Y-m-d');
        $data['created_at'] = $now;
        $data['updated_at'] = null;
        $data['name'] = Input::get('name');
        $data['owner'] = $userService->getUserId();

        $result  = $playlistMapper->create($data);
        echo json_encode(array('status'=> 1, 'message' => 'all good'));



    }
}
Redirect::to('index.php');


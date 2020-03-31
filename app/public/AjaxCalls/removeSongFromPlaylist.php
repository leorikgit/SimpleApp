<?php
include_once __DIR__."../../../core/ini.php";
use Utility\Input;

use Utility\Redirect;

if(Input::exist('HTTP_X_REQUESTED_WITH')) {
    if(!$userService->isLogin()){
        Redirect::to(403);
    }

    if(!empty(Input::get('songId')) && !empty(Input::get('playlistId'))){

        $playlistMapper = new \Playlist\PlaylistMapper($conn);
        $playlistFactory  = new \Playlist\PlaylistFactory();
        $playlistRepository = new \Playlist\PlaylistRepository($playlistMapper, $playlistFactory);

        $playlist = $playlistRepository->find(Input::get('playlistId'));
        if(!$playlist){
            echo json_encode(array('status'=> 0, 'message' => 'Playlist doesnt exist.'));
            exit();
        }
        if($playlist->getOwner() != $userService->getUserId()){
            echo json_encode(array('status'=> 0, 'message' => 'permission denied'));
            exit();
        }
        $playlistSongMapper = new \PlaylistSong\PlaylistSongMapper($conn);
        $playlistSongQuery = new \PlaylistSong\PlaylistSongQuery($playlistSongMapper);

        $playlistSong = $playlistSongQuery->findSong(Input::get('songId'), Input::get('playlistId'));

        if(!$playlistSong){
            echo json_encode(array('status'=> 0, 'message' => 'Song doesnt exist.'));
            exit();
        }
        $playlistSongFactory = new \PlaylistSong\PlaylistSongFactory();
        $playlistSong = $playlistSongFactory->createPlaylistSong($playlistSong);
        $playlistSongRepository = new \PlaylistSong\PlaylistSongRepository($playlistSongMapper);


        $result = $playlistSongRepository->delete($playlistSong);

        if(!$result){
            echo json_encode(array('status'=> 0, 'message' => 'Something went wrong, please try again later'));
            exit();
        }
        echo json_encode(array('status'=> 1, 'message' => 'Song has been deleted from the playlist.'));
        exit();



    }
}
Redirect::to('index.php');


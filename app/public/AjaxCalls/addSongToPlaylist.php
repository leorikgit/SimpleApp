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

        $checkIfSongExists = $playlistSongQuery->checkIFExists(array('playlistId'=>$playlist->getId(), 'songId'=>Input::get('songId')));
        if($checkIfSongExists){
            echo json_encode(array('status'=> 1, 'message' => 'Song has been added to the playlist'));
            exit();
        }

        $playlistSongFactory = new \PlaylistSong\PlaylistSongFactory();
        $songOrder = $playlistSongQuery->findSongsMaxOrderByPlaylistId($playlist->getId());
        $songOrder = $songOrder['song_order'] ? $songOrder['song_order'] : 1;
        $data = array();
        $data['playlist_id'] = $playlist->getId();
        $data['song_id'] = Input::get('songId');
        $data['song_order'] = $songOrder;
        $now = new \DateTime();
        $now = $now->format('Y-m-d');

        $data['created_at'] = $now;
        $data['updated_at'] = null;

        $playlistSong = $playlistSongFactory->createPlaylistSong($data);


        $playlistSongRepository = new \PlaylistSong\PlaylistSongRepository($playlistSongMapper);

        $result = $playlistSongRepository->save($playlistSong);
        if(!$result){
            echo json_encode(array('status'=> 0, 'message' => 'Something went wrong, please try again later'));
            exit();
        }
        echo json_encode(array('status'=> 1, 'message' => 'Song has been added to the playlist'));
        exit();



    }
}
Redirect::to('index.php');


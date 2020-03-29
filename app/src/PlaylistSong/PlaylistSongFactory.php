<?php
namespace PlaylistSong;
class PlaylistSongFactory implements PlaylistSongFactoryI{

    public function createPlaylistSong($data)
    {

        $playlist = new PlaylistSong();
        if(isset($data['id'])){
            $playlist->setId($data['id']);
        }
        $playlist->setPlaylistId($data['playlist_id']);
        $playlist->setSongId($data['song_id']);
        $playlist->setSongOrder($data['song_order']);
        $playlist->setCreatedAt($data['created_at']);
        $playlist->setUpdatedAt($data['updated_at']);
        return $playlist;
    }
}
<?php
namespace Playlist;
class PlaylistFactory implements PlaylistFactoryI{

    public function createPlaylist($data)
    {
        $playlist = new Playlist();
        if(isset($data['id'])){
            $playlist->setId($data['id']);
        }
        $playlist->setName($data['name']);
        $playlist->setOwner($data['owner']);
        $playlist->setCreatedAt($data['created_at']);
        $playlist->setUpdatedAt($data['updated_at']);
        return $playlist;
    }
}
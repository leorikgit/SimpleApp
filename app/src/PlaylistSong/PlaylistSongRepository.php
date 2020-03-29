<?php
namespace PlaylistSong;
class PlaylistSongRepository implements PlaylistSongRepositoryI{
    private $_playlistSongMapper;
    public function __construct(PlaylistSongMapperI $playlistSongMapper)
    {
        $this->_playlistSongMapper = $playlistSongMapper;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
    public function save(PlaylistSongI $playlistSong)
    {

        $data = [];
        $data['id'] = $playlistSong->getId();
        $data['playlist_id'] = $playlistSong->getPlaylistId();
        $data['song_id'] = $playlistSong->getSongId();
        $data['song_order'] = $playlistSong->getSongOrder();
        $data['created_at'] = $playlistSong->getCreatedAt();
        $data['updated_at'] = $playlistSong->getUpdatedAt();
        if($data['id']){
            return $this->update($data);
        }else{
            return  $this->create($data);
        }
    }
    private function create($data){

        return $this->_playlistSongMapper->create($data);
    }
    public function remove(PlaylistSongI $playlistSong)
    {
        // TODO: Implement remove() method.
    }
}
<?php
namespace Playlist;
class PlaylistRepository implements PlaylistRepositoryI{

    private $_playlistMapper,
            $_playlistFactory;
    public function __construct(PlaylistMapperI $playlistMapper, PlaylistFactory $playlistFactory)
    {
        $this->_playlistMapper = $playlistMapper;
        $this->_playlistFactory = $playlistFactory;
    }

    public function find($id)
    {
        $data = $this->_playlistMapper->find($id);
        if(!$data){
            return false;







        }
        return $this->_playlistFactory->createPlaylist($data);
    }
    public function save(PlaylistI $playlist)
    {
        $data = [];
        $data['id'] = $playlist->getId();
        $data['name'] = $playlist->getName();
        $data['owner'] = $playlist->getOwner();
        $data['created_at'] = $playlist->getCreatedAt();
        $data['updated_at'] = $playlist->getUpdatedAt();
        if($data['id']){
            $this->update($data);
        }else{
            $this->create($data);
        }
    }
    public function remove(PlaylistI $playlist)
    {
        return $this->_playlistMapper->delete($playlist->getId());
    }
    public function create($data){
        return $this->_playlistMapper->create($data);
    }
    public function update($data){

    }
}

<?php
namespace Playlist;
use Database\Adapter\AdapterI;

class PlaylistMapper implements PlaylistMapperI{
    private $_adapter;
    public function __construct(AdapterI $source)
    {
        $this->_adapter = $source;
    }

    public function find($id)
    {
        return $this->_adapter->find("SELECT * FROM playlists WHERE id=?", $id);
    }
    public function query($sql, $one, $params)
    {
        if($one){
            return  $this->_adapter->query($sql, $params)->getResult();
        }
        return $this->_adapter->query($sql, $params)->getResults();
    }
    public function create($data)
    {
        return $this->_adapter->insert('playlists', $data);
    }
    public function delete($id){
        return $this->_adapter->delete("DELETE FROM playlists WHERE id=?", array($id));
    }
}
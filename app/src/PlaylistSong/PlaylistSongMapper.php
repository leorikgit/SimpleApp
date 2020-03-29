<?php
namespace PlaylistSong;
use Database\Adapter\AdapterI;

class PlaylistSongMapper implements PlaylistSongMapperI{
    private $_adapter;

    public function __construct(AdapterI $adapter)
    {
        $this->_adapter = $adapter;
    }
    public function find()
    {
        // TODO: Implement find() method.
    }
    public function create($params)
    {

        return $this->_adapter->insert('songs_playlist',$params );
    }
    public function query($sql, $one, $params){
        $result =  $this->_adapter->query($sql, $params);

        if($result->getError()){
            throw new \Exception('Something goes wrong');
        }
        if($one){
            return $result =  $this->_adapter->query($sql, $params)->getResult();
        }
        return $this->_adapter->query($sql, $params)->getResults();
    }

}
<?php
namespace Playlist;
class PlaylistQuery implements PlaylistQueryI{
    private $_playlistMapper;
    public function __construct(PlaylistMapperI $playlistMapper)
    {
        $this->_playlistMapper = $playlistMapper;
    }

    public function getOwnerPlaylistById($data)
    {
        return $this->_playlistMapper->Query("SELECT p.*, u.username as owner FROM playlists p LEFT JOIN users u ON p.owner=u.id WHERE p.id=? AND p.owner=?", TRUE, array($data['playlistId'], $data['ownerId']));
    }
    public function findAllPlaylistByOwnerId($id){

        $sql = "SELECT * FROM playlists WHERE owner=?";
        return $this->_playlistMapper->query($sql, FALSE, array($id));
    }
    public function findPlaylistByName($name){
        $sql = "SELECT * FROM playlists WHERE name=?";
        return $this->_playlistMapper->query($sql, TRUE, array($name));
    }
    public function showPlaylistsNameByOwnerId($id){
        $sql = "SELECT id, name FROM playlists WHERE owner=?";
        return $this->_playlistMapper->query($sql, FALSE, array($id));
    }

}
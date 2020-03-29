<?php
namespace PlaylistSong;
class PlaylistSongQuery implements PlaylistSongQueryI{
    private $_playlistSongMapper;
    public function __construct(PlaylistSongMapperI $playlistSongMapper)
    {
        $this->_playlistSongMapper = $playlistSongMapper;
    }

    public function findSongsByPlaylistId($id){
        $sql = "SELECT * FROM songs_playlist WHERE playlist_id=?";
        return $this->_playlistSongMapper->query($sql, FALSE, array());
    }
    public function findSongsMaxOrderByPlaylistId($id){
        $sql = "SELECT MAX(song_order) + 1 as song_order FROM songs_playlist WHERE playlist_id=?";
        return $this->_playlistSongMapper->query($sql, TRUE, array($id));
    }
    public function checkIFExists($data){
        $sql = "SELECT * FROM songs_playlist WHERE playlist_id=? AND song_id=?";
        return $this->_playlistSongMapper->query($sql, TRUE, $data);
    }

}
<?php
namespace Song;
class SongQuery implements SongQueryI{
    private $_albumMapper,
        $_albumCollection;

    public function __construct(SongMapperI $songMapper, SongCollectionI $albumCollection)
    {
        $this->_albumMapper = $songMapper;
        $this->_albumCollection = $albumCollection;
    }
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }
    public function findAll()
    {
        return $this->_albumMapper->query("SELECT * FROM songs", FALSE, array());
    }
    public function findTenRandomSongs(){
        $sql = "SELECT s.*, a.name as artist_name, al.art_work_path as album_path FROM songs s LEFT JOIN artists a ON s.artist=a.id LEFT JOIN albums al ON s.album=al.id ORDER BY RAND() LIMIT 10";

        return $this->_albumMapper->query($sql, FALSE, array());
    }
    public function findAllAlbumSongsByID($id)
    {
        $sql = "SELECT s.*, a.name as artist_name, al.art_work_path as album_path FROM songs s LEFT JOIN artists a ON s.artist=a.id LEFT JOIN albums al ON s.album=al.id WHERE al.id=?";
        return $this->_albumMapper->query($sql, FALSE, array($id));
    }
    public function findAllSongsByArtist($id)
    {
        $sql = "SELECT s.*, a.name as artist_name, al.art_work_path as album_path FROM songs s LEFT JOIN artists a ON s.artist=a.id LEFT JOIN albums al ON s.album=al.id WHERE s.artist=?";
        return $this->_albumMapper->query($sql, FALSE, array($id));
    }

    public function findAllSongsBySearch($search){

        $sql = "SELECT s.*, a.name as artist_name, al.art_work_path as album_path FROM songs s LEFT JOIN artists a ON s.artist=a.id LEFT JOIN albums al ON s.album=al.id WHERE s.title LIKE ? LIMIT 100";
        return $this->_albumMapper->query($sql, FALSE, array("%".$search."%"));
    }
    public function findAllSongsByPlaylistId($id){
        $sql = "SELECT s.*,sp.song_order as `order`, u.username as artist_name FROM songs s LEFT JOIN songs_playlist sp ON s.id=sp.song_id LEFT JOIN playlists p ON sp.playlist_id= p.id LEFT JOIN users u ON s.artist=u.id WHERE p.id=?";
        return $this->_albumMapper->query($sql, FALSE, array($id));
    }
}

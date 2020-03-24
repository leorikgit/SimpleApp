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
    public function findAllAlbumSongsByID(){
        $sql = "SELECT s.*, a.name as artist_name, al.art_work_path as album_path FROM songs s LEFT JOIN artists a ON s.artist=a.id LEFT JOIN albums al ON s.album=al.id ORDER BY RAND() LIMIT 10";

        return $this->_albumMapper->query($sql, FALSE, array());
    }
}

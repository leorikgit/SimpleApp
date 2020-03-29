<?php
namespace Album;
class AlbumQuery implements AlbumQueryI{
    private $_albumMapper,
            $_albumCollection;

    public function __construct(AlbumMapperI $albumMapper, AlbumCollectionI $albumCollection)
    {
     $this->_albumMapper = $albumMapper;
     $this->_albumCollection = $albumCollection;
    }
    public function getById($id)
    {
        $sql = "SELECT al.*, ar.name as artist_name, ge.name as genre_name FROM albums al LEFT JOIN artists ar ON al.artist=ar.id LEFT JOIN genres ge ON al.genre=ge.id WHERE al.id=?";
        return $this->_albumMapper->query($sql, TRUE, array($id));
    }
    public function findAll()
    {
        return $this->_albumMapper->query("SELECT * FROM albums", FALSE, array());

    }
    public function getAlbumsByArtist($id){
        return $this->_albumMapper->query("SELECT * FROM albums WHERE artist=?", FALSE, array($id));
    }
    public function findAllByName($search){
        $sql = "SELECT * FROM albums WHERE title LIKE ? LIMIT 100";
        return $this->_albumMapper->query($sql, FALSE, array("%".$search."%"));
    }

}

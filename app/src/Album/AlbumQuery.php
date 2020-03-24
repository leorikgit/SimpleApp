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
        // TODO: Implement getById() method.
    }
    public function findAll()
    {
        return $this->_albumMapper->query("SELECT * FROM albums", FALSE, array());

    }
}

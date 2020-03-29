<?php
namespace Artist;
class ArtistQuery implements ArtistQueryI{
    private $_artistCollection,
            $_artistMApper;

    public function __construct(ArtistMapper $artistMApper, ArtistCollectionI $artistCollection)
    {
        $this->_artistMApper = $artistMApper;
        $this->_artistCollection  = $artistCollection;
    }
    public function findAllByName($search){
        $sql = "SELECT * FROM artists WHERE name LIKE ? LIMIT 100";
        return $this->_artistMApper->query($sql, FALSE, array("%".$search."%"));
    }

}

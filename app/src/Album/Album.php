<?php
namespace Album;
class Album implements AlbumI{
    private $_id,
        $_title,
        $_artist,
        $_art_work_path,
        $_created_at,
        $_updated_at;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->_artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->_artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getArtWorkPath()
    {
        return $this->_art_work_path;
    }

    /**
     * @param mixed $art_work_path
     */
    public function setArtWorkPath($art_work_path)
    {
        $this->_art_work_path = $art_work_path;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->_updated_at = $updated_at;
    }

}

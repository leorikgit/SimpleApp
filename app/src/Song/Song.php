<?php
namespace Song;
class Song implements SongI{
    private $_id,
            $_title,
            $_album,
            $_artist,
            $_genre,
            $_duration,
            $_path,
            $_album_order,
            $_play_count,
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
    public function getAlbum()
    {
        return $this->_album;
    }

    /**
     * @param mixed $album
     */
    public function setAlbum($album)
    {
        $this->_album = $album;
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
    public function getGenre()
    {
        return $this->_genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->_genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->_duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->_path = $path;
    }

    /**
     * @return mixed
     */
    public function getAlbumOrder()
    {
        return $this->_album_order;
    }

    /**
     * @param mixed $album_order
     */
    public function setAlbumOrder($album_order)
    {
        $this->_album_order = $album_order;
    }

    /**
     * @return mixed
     */
    public function getPlayCount()
    {
        return $this->_play_count;
    }

    /**
     * @param mixed $play_count
     */
    public function setPlayCount($play_count)
    {
        $this->_play_count = $play_count;
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
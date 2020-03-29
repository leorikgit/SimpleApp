<?php
namespace PlaylistSong;
class PlaylistSong implements PlaylistSongI{
    private $_id,
            $_playlistId,
            $_songId,
            $_songOrder,
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
    public function getPlaylistId()
    {
        return $this->_playlistId;
    }

    /**
     * @param mixed $playlistId
     */
    public function setPlaylistId($playlistId)
    {
        $this->_playlistId = $playlistId;
    }

    /**
     * @return mixed
     */
    public function getSongId()
    {
        return $this->_songId;
    }

    /**
     * @param mixed $songId
     */
    public function setSongId($songId)
    {
        $this->_songId = $songId;
    }

    /**
     * @return mixed
     */
    public function getSongOrder()
    {
        return $this->_songOrder;
    }

    /**
     * @param mixed $songOrder
     */
    public function setSongOrder($songOrder)
    {
        $this->_songOrder = $songOrder;
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
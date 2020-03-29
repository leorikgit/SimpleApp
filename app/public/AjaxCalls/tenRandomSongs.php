<?php
include_once __DIR__."../../../core/ini.php";
use \Song\SongQuery;
use \Song\SongMapper;
use \Song\SongCollection;
$songMapper = new SongMapper($conn);
$songCollection = new SongCollection();
$songQuery = new SongQuery($songMapper, $songCollection);
$songs = $songQuery->findTenRandomSongs();
echo json_encode($songs);
<?php

use Playlist\PlaylistMapper;
use \Playlist\PlaylistQuery;
use Utility\Input;

$playlistMapper = new PlaylistMapper($conn);
$playlistQuery = new PlaylistQuery($playlistMapper);
$playlist = $playlistQuery->getOwnerPlaylistById(array("playlistId"=>Input::get('id'), "ownerId"=>$userService->getUserId()));

$songMapper = new \Song\SongMapper($conn);
$songCollection = new \Song\SongCollection();
$songQuery = new \Song\SongQuery($songMapper, $songCollection);
$songs = $songQuery->findAllSongsByPlaylistId($playlist['id']);

$playlistMapper = new \Playlist\PlaylistMapper($conn);
$playlistQuery = new \Playlist\PlaylistQuery($playlistMapper);
$playlists = $playlistQuery->showPlaylistsNameByOwnerId($userService->getUserId());

?>
<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo BASE_URL."assets/images/icons/playlist.png"?>">
    </div>
    <div class="rightSection">
        <h1><?php echo $playlist['name']?></h1>
        <p> By <?php echo $playlist['owner']?></p>
        <p> <?php echo $songs ? count($songs) : 0?> song</p>
        <div>
            <button class="button" onclick="deletePlaylist(<?php echo $playlist['id']?>);">DELETE PLAYLIST</button>
        </div>
    </div>
</div>
<?php
if($songs){
    ?>
    <div class="trackListContainer">
        <ul class="trackList">
            <?php
            $i = 1;
            foreach ($songs as $song){

                ?>
                <li class="trackListRow">
                    <div class="trackCount">
                        <img class="play" src="<?php echo BASE_URL."assets/images/icons/play-white.png"?>" onclick="setTempList(<?php echo $i -1 ?>)">
                        <span class="trackNumber"><?php echo $i?></span>
                    </div>
                    <div class="trackInfo">
                        <span class="trackTitle"><?php echo $song['title']?></span>
                        <span class="tackArtist"><?php echo $song['artist_name']?></span>
                    </div>
                    <div class="trackOption">
                        <input class="songId" type="hidden" value="<?php echo $song['id']?>">
                        <img class="optionButton pointer" src="<?php echo BASE_URL."assets/images/icons/more.png"?>" onclick="openOptionMenu(this)">
                    </div>
                    <div class="trackDuration">
                        <span><?php echo $song['duration']?></span>
                    </div>
                </li>
                <?php
                $i++;
            }
            ?>
            <script>
                var tempSongs = '<?php echo json_encode($songs); ?>';
                tempList = JSON.parse(tempSongs);
            </script>
        </ul>
    </div>
    <?php
}

?>

<nav class="optionMenu">
    <input type="hidden" class="songId" value="">
    <select class="item playlist">
        <option value="">Select playlist</option>
        <?php
        foreach ($playlists as $thisPlaylist){
            echo "<option value=".$thisPlaylist['id'].">".$thisPlaylist['name']."</option>";
        }

        ?>

    </select>
    <div class="item" onclick="deleteSongFromPlaylist(this, <?php echo $playlist['id']?>);">Remove from playlist</div>
</nav>



<?php
use \Album\AlbumMapper;
use \Album\AlbumCollection;
use \Album\AlbumQuery;
use Utility\Input;
use \Song\SongMapper;
use Song\SongCollection;
use Song\SongQuery;


$albumMapper = new AlbumMapper($conn);
$albumCollection = new AlbumCollection();
$albumService = new AlbumQuery($albumMapper, $albumCollection);

$album = $albumService->getById(Input::get('id'));

$songMapper = new SongMapper($conn);
$songCollection = new SongCollection();
$songQuery = new SongQuery($songMapper, $songCollection);
$songs = $songQuery->findAllAlbumSongsByID(Input::get('id'));

$playlistMapper = new \Playlist\PlaylistMapper($conn);
$playlistQuery = new \Playlist\PlaylistQuery($playlistMapper);
$playlists = $playlistQuery->showPlaylistsNameByOwnerId($userService->getUserId());


?>
<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo BASE_URL."assets/upload/artwork/".$album['art_work_path']?>">
    </div>
    <div class="rightSection">
        <h1><?php echo $album['title']?></h1>
        <p> By <?php echo $album['artist_name']?></p>
        <p> <?php echo $songs ? count($songs) : 0?> song</p>
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
        foreach ($playlists as $playlist){
            echo "<option value=".$playlist['id'].">".$playlist['name']."</option>";
        }
        ?>
    </select>
    <div class="item">next option</div>
    <div class="item">next option</div>
</nav>

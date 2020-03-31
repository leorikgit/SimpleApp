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
$albumQuery = new AlbumQuery($albumMapper, $albumCollection);

$albums = $albumQuery->getAlbumsByArtist(Input::get('id'));

$songMapper = new SongMapper($conn);
$songCollection = new SongCollection();
$songQuery = new SongQuery($songMapper, $songCollection);
$songs = $songQuery->findAllSongsByArtist(Input::get('id'));

$playlistMapper = new \Playlist\PlaylistMapper($conn);
$playlistQuery = new \Playlist\PlaylistQuery($playlistMapper);
$playlists = $playlistQuery->showPlaylistsNameByOwnerId($userService->getUserId());

?>
<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1>artist name</h1>
            <div class="headerButtons">
                <button class="button green" onclick="setTempList(0)">PLAY</button>
            </div>
        </div>
    </div>
</div>
<div class="trackListContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="trackList">
        <?php
        $i = 1;
        foreach ($songs as $song){
            if($i == 6){
                break;
            }
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
<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
    foreach ($albums as $album){
        ?>
        <span role="link" tabindex="0" onclick="loadpage('<?php  echo BASE_URL . "album.php?id=" . $album['id']?>')">
            <div class="gridViewItem">
                <img src="<?php echo BASE_URL."assets/upload/artwork/".$album['art_work_path']?>">
                <div class="gridViewText">
                    <?php echo $album['title']?>
                </div>
            </div>
        </span>
        <?php
    }
    ?>
</div>
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
</nav>

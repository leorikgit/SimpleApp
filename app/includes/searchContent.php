<?php
use Utility\Input;
use \Song\SongMapper;
use Song\SongCollection;
use Song\SongQuery;

use \Artist\ArtistMapper;
use \Artist\ArtistCollection;
use \Artist\ArtistQuery;

use Album\AlbumMapper;
use Album\AlbumCollection;
use Album\AlbumQuery;
$songMapper = new SongMapper($conn);
$songCollection = new SongCollection();
$songQuery = new SongQuery($songMapper, $songCollection);
$songs = $songQuery->findAllSongsBySearch(Input::get('term'));

$artistMapper = new ArtistMapper($conn);
$artistCollection = new ArtistCollection();
$artistQuery = new ArtistQuery($artistMapper, $artistCollection);
$artists = $artistQuery->findAllByName(Input::get('term'));

$albumMapper = new AlbumMapper($conn);
$albumCollection = new AlbumCollection();
$albumQuery = new AlbumQuery($albumMapper, $albumCollection);
$albums = $albumQuery->findAllByName(Input::get('term'));

$playlistMapper = new \Playlist\PlaylistMapper($conn);
$playlistQuery = new \Playlist\PlaylistQuery($playlistMapper);
$playlists = $playlistQuery->showPlaylistsNameByOwnerId($userService->getUserId());

?>

<div id="searchContainer">
    <h4>Search for albums, articles or songs</h4>
    <input class="searchInput" type="text" placeholder="Start typing..." value="<?php echo Input::get('term')?>" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>
<script>
    $('document').ready(function() {

        $(".searchInput").focus();
        $(".searchInput").keyup(function(){
            clearTimeout(timer);
            timer = setTimeout(function(){
                var val = $(".searchInput").val();
                loadpage("search.php?term="+ val);

            },2000)
        })
    });
</script>
<?php if(Input::get('term') == ''){
    exit();
}?>
<div class="trackListContainer borderBottom">
    <h2>SONGS</h2>
<?php
if(!$songs){
    echo "<span class='noResults'>No songs</span>";
}else{
    ?>

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

<?php
}
?>
</div>

<div class="artistSearchContainer borderBottom">
    <h2>ARTISTS</h2>
    <?php
    if(!$artists){
        echo "<span class='noResults'>No artists</span>";
    }else{
        foreach ($artists as $artist)
        ?>

        <div class="searchRow">
            <div class="artistName">
                <span><?php echo $artist['name']?></span>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div class="gridViewContainer borderBottom">
    <h2>ALBUMS</h2>
    <?php
    if(!$albums){
        echo "<span class='noResults'>No artists</span>";
    }else{
        foreach ($albums as $album)
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
<?php
use Playlist\PlaylistMapper;
use Playlist\PlaylistCollection;
use \Playlist\PlaylistQuery;
$playlistMapper = new playlistMapper($conn);
$playlistCollection = new playlistCollection();
$playlistQuery = new PlaylistQuery($playlistMapper);

$playlists = $playlistQuery->findAllPlaylistByOwnerId($userService->getUserId());

?>
<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>
        <div class="buttonItem">
            <button class="button green" onclick="createPlaylist();">New playlist</button>
        </div>
        <?php
        foreach ($playlists as $playlist){
            ?>
            <span role="link" tabindex="0" onclick="loadpage('<?php  echo BASE_URL . "playlist.php?id=" . $playlist['id']?>')">
            <div class="gridViewItem">
                <div class="borderImage">
                    <img src="<?php echo BASE_URL."assets/images/icons/playlist.png"?>">
                </div>

                <div class="gridViewText">
                    <?php echo $playlist['name']?>
                </div>
            </div>
        </span>
            <?php
        }
        ?>
    </div>

</div>


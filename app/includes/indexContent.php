<?php
use \Album\AlbumMapper;
use \Album\AlbumCollection;
use \Album\AlbumQuery;
$albumMapper = new AlbumMapper($conn);
$albumCollection = new AlbumCollection();
$albumQuery = new AlbumQuery($albumMapper, $albumCollection);
$albums = $albumQuery->findAll();
?>
<h1 class="mainViewHeader">You might aslo like</h1>
<div class="gridViewContainer">
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
<div id="mainContainer">

    <div id="topContainer">
        <div id="navBarContainer">
            <nav id="navBar">
            <span class="logo" role="link" tabindex="0" onclick="loadpage('profile.php')">
                <img src="<?php echo "/assets/images/icons/logo.png"?>">
            </span>
                <div class="group">
                    <div class="navItem">
                        <a href="" class="navItemLink">Search
                            <img src="<?php echo "/assets/images/icons/search.png"?>" class="icon">
                        </a>
                    </div>
                </div>
                <div class="group">
                    <div class="navItem">
                        <a href="" class="navItemLink">Browse</a>
                    </div>
                    <div class="navItem">
                        <a href="" class="navItemLink">Your Music</a>
                    </div>
                    <div class="navItem">
                        <a href="" class="navItemLink">Reace Kennay</a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="mainViewContainer">
            <div id="mainLoader" style="visibility: hidden">
                <img width="25px" src="/assets/images/icons/loading.gif">
            </div>
            <div id="mainContent">
                 <?php include_once ROOT_PATH."includes/indexContent.php" ?>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH."includes/indexNowPlayingBarContainer.php"?>
</div>





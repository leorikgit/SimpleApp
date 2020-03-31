<div id="mainContainer">

    <div id="topContainer">
        <div id="navBarContainer">
            <nav id="navBar">
            <span class="logo" role="link" tabindex="0" onclick="loadpage('index.php')">
                <img src="<?php echo "/assets/images/icons/logo.png"?>">
            </span>
                <div class="group">
                    <div class="navItem">
                        <a  class="navItemLink pointer" onclick="loadpage('search.php')">Search
                            <img src="<?php echo "/assets/images/icons/search.png"?>" class="icon">
                        </a>
                    </div>
                </div>
                <div class="group">
                    <div class="navItem">
                        <a href="" class="navItemLink">Browse</a>
                    </div>
                    <div class="navItem">
                        <a  class="navItemLink pointer" onclick="loadpage('yourMusic.php')">Your Music

                        </a>
                    </div>
                    <div class="navItem">
                        <a  class="navItemLink pointer" onclick="loadpage('settings.php')">Settings
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="mainViewContainer">
            <div id="mainLoader" style="visibility: hidden">
                <img width="25px" src="/assets/images/icons/loading.gif">
            </div>
            <div id="mainContent">
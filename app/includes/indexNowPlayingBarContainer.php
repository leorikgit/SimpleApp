<?php


?>
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <span role="link" tabindex="0" class="albumLink">
                <img src="" class="albumArtwork">
            </span>
            <div class="trackInfo">
                <span role="link" tabindex="0" class="artistName">Artist Name</span>
                <span role="link" tabindex="0" class="songTitle">Song Title</span>
            </div>

        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">

                <div class="Buttons">
                    <button class="controlButton shuffle" title="Shuffle" onclick="setShuffle()">
                        <img src="<?php echo "/assets/images/icons/shuffle.png"?>">
                    </button>
                    <button class="controlButton previous" title="Previous" onclick="previousSong()">
                        <img src="<?php echo "/assets/images/icons/previous.png"?>">
                    </button>
                    <button class="controlButton play" title="Play" onclick=playSong();>
                        <img src="<?php echo "/assets/images/icons/play.png"?>">
                    </button>
                    <button class="controlButton pause" title="Pause" style="display: none" onclick=pauseSong();>
                        <img src="<?php echo "/assets/images/icons/pause.png"?>">
                    </button>
                    <button class="controlButton next" title="Next" onclick="nextSong()">
                        <img src="<?php echo "/assets/images/icons/next.png"?>">
                    </button>
                    <button class="controlButton repeat" title="Repeat" onclick=repeatSong();>
                        <img src="<?php echo "/assets/images/icons/repeat.png"?>">
                    </button>
                </div>
                <div id="playbackBar">
                    <div class="progressTime currentTime">0.00</div>
                    <div class="progressBar">
                        <div class="progressBarBG">
                            <div id="progress"></div>
                        </div>
                    </div>
                    <div class="progressTime remainingTime">0.00</div>
                </div>
            </div>
        </div>

        <div id="nowPlayingRight">
            <div id="volumeBar">
                <button class="controlButton volume" title="Volume">
                    <img src="<?php echo "/assets/images/icons/volume.png"?>">
                </button>
                <div class="progressBar">
                    <div class="progressBarBG">
                        <div id="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loader" style="visibility: hidden; padding: 0;position: fixed">
        <img width="25px" src="/assets/images/icons/loading.gif">
    </div>
</div>

<script>

    $('document').ready(function(){
        $audioElement = new Audio();
        updateVolumeProgressBar($audioElement.audio);

        $("#nowPlayingBar").css("visibility",'hidden');
        $("#loader").css("visibility",'visible');

        const promise1 = new Promise(function(resolve, reject) {
            setTimeout(resolve, 1000, 'delay');
        });
        const promise2 = getcurrentlySongs();
        // const promise3 = getTempSongs();
        Promise.all([promise1, promise2]).then(function(values) {
            //tempList = values[2];
            var newPlayList = values[1];
            setTrack(newPlayList[0], newPlayList, false);
            $("#nowPlayingBar").css("visibility",'visible');
            $("#loader").css("visibility",'hidden');

        }).catch((err) => {console.log(err)});



        // console.log(currentlySongs);
        $("#nowPlayingBarContainer").on('mousedown mousemove touchstart touchmove', function(e){
            e.preventDefault();
        });

        $("#playbackBar .progressBar").mousedown(function(e){
            mouseDown = true;
        });
        $("#playbackBar .progressBar").mousemove(function(e){
            if(mouseDown){
                timeFromOffSet(e, this);
            }
        });
        $("#playbackBar .progressBar").mouseup(function(e){
            timeFromOffSet(e, this);

        });
        $(document).mouseup(function(){
            mouseDown = false;
        });

        // volume
        $("#volumeBar .progressBar").mousedown(function(e){
            mouseDown = true;
        });
        $("#volumeBar .progressBar").mousemove(function(e){
            if(mouseDown){
                setVolume(e, this);
            }
        });
        $("#volumeBar .progressBar").mouseup(function(e){
            setVolume(e, this);

        })
        function setVolume(event, progressBar){
            var percent = event.offsetX / $(progressBar).width();

            $audioElement.setVolume(percent);
        };

    });

    function timeFromOffSet(event, progressBar){

        var percent = (event.offsetX / $(progressBar).width()) * 100;
        var seconds = $audioElement.audio.duration * (percent / 100);
        $audioElement.setCurrentTime(seconds);

    }
    function setShuffle(){

        shuffle = !shuffle;
        var img = shuffle ? "/assets/images/icons/shuffle-active.png" : "/assets/images/icons/shuffle.png";
        $(".controlButton.shuffle img").attr("src", img);

        if(shuffle){

            shiffleArray(shuffleSongs);


            shiffleArray(shuffleSongs);
            currentIndex = shuffleSongs.indexOf($audioElement.currentlyPlaying);

        }else{
            currentIndex = currentlySongs.indexOf($audioElement.currentlyPlaying);

        }

    }

    function shiffleArray(a){

        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;

    }
    function setTempList(position){
        setTrack(tempList[position], tempList, true);

    }
    function setTrack($currentSong, newPlaylist, play){

        if(currentlySongs != newPlaylist){
            currentlySongs = newPlaylist;
            shuffleSongs = currentlySongs.slice();
            shiffleArray(shuffleSongs);
        }
        currentIndex = (shuffle) ? shuffleSongs.indexOf($currentSong) : currentlySongs.indexOf($currentSong);
        console.log($currentSong);
        $(".trackInfo .artistName").text($currentSong.artist_name);
        $(".trackInfo .artistName").attr("onclick", "loadpage('artist.php?id="+ $currentSong.artist +"')");
        $(".trackInfo .songTitle").text($currentSong.title);
        $(".trackInfo .songTitle").attr("onclick", "loadpage('artist.php?id="+ $currentSong.artist +"')");
        $(".albumLink .albumArtwork").attr('src',"assets/upload/artwork/"+$currentSong.album_path);
        $(".albumLink .albumArtwork").attr("onclick", "loadpage('album.php?id="+ $currentSong.album +"')");

        $audioElement.setTrack($currentSong);

        if(play){
            playSong();
        }
    }
    function previousSong(){

        if(currentIndex == 0 || $audioElement.audio.currentTime >= 3){
            $audioElement.setTime(0);
        }else{
            currentIndex = currentIndex - 1;
            var prevoiusToPlay = currentlySongs[currentIndex];
            setTrack(prevoiusToPlay, currentlySongs, true);
        }

    }





    function nextSong(){

        if(repeat){
            $audioElement.setTime(0);
            playSong();
            return;
        }
        if(currentIndex == currentlySongs.length -1){
            currentIndex = 0;
        }else{
            currentIndex++;
        }
        var trackToPlay = (shuffle) ? shuffleSongs[currentIndex] : currentlySongs[currentIndex];

        setTrack(trackToPlay, currentlySongs, true);
    }
    function playSong(){
        if($audioElement.audio.currentTime == 0){
            $.post('includes/handlers/playCounterAjax.php',{songId:$audioElement.currentlyPlaying.id});

        }
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();

        $audioElement.play();

    }
    function pauseSong(){
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        $audioElement.pause();
    }

    function repeatSong(){
        repeat = !repeat;
        var img = repeat ? "/assets/images/icons/repeat-active.png" : "/assets/images/icons/repeat.png";
        $(".controlButton.repeat img").attr("src", img);
    }



    function getcurrentlySongs(){
        console.log('here');
        return new Promise((resolve, reject) => {
            $.ajax('AjaxCalls/tenRandomSongs.php',
                {
                    dataType: 'json', // type of response data
                    timeout: 500,     // timeout milliseconds

                    success: function (data,status,xhr) {   // success callback function
                        resolve(data)
                    },
                    error: function (jqXhr, textStatus, errorMessage) { // error callback
                        reject(errorMessage)
                    }
                });
        })
    }
    // function getTempSongs(){
    //
    //     $id = getUrlParameter("id");
    //     return new Promise((resolve, reject) => {
    //         $.ajax('includes/tempSongs.php',
    //             {
    //                 dataType: 'json', // type of response data
    //                 timeout: 500,     // timeout milliseconds
    //                 type: "POST",
    //                 data:{id:$id},
    //                 success: function (data, status, xhr) {   // success callback function
    //                     resolve(data)
    //                 },
    //                 error: function (jqXhr, textStatus, errorMessage) { // error callback
    //                     reject(errorMessage)
    //                 }
    //             });
    //     })
    // }

</script>
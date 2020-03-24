var mouseDown = false;
var currentlySongs;
var shuffleSongs;
var tempList;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
function Audio() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.setTrack = function(track){
        this.currentlyPlaying = track;

        this.audio.src = "assets/upload/music/"+track.path;
    };
    this.play = function(){
        this.audio.play();
    };
    this.pause = function(){
        this.audio.pause();
    };
    this.audio.addEventListener('canplay', function(){
        var duration = formatTime(this.duration);
        $(".progressTime.remainingTime").text(duration);
    });
    this.audio.addEventListener('ended', function(){
        console.log('qwe');
        nextSong();
    });
    this.audio.addEventListener('timeupdate', function(){
        if(this.duration){
            updateTimeProgressBar(this);
        }

    });
    this.setTime = function(time){
        this.audio.currentTime = time;
    };
    this.audio.addEventListener('volumechange', function(){
            updateVolumeProgressBar(this);
    });
    this.setCurrentTime = function(seconds){
        this.audio.currentTime = seconds;
    };
    this.setVolume = function(volume){
        if(volume <= 1 && volume >= 0){
            console.log(volume);
        this.audio.volume = volume;
        }
    }
}
function updateVolumeProgressBar(audio){
    var volume = audio.volume * 100;
    $("#volumeBar .progressBarBG #progress").css('width', volume + "%");

}
function updateTimeProgressBar(audio){
    var duration = formatTime(audio.currentTime);
    $(".progressTime.currentTime").text(duration);
    $(".progressTime.remainingTime").text(formatTime(audio.duration - audio.currentTime));

    var progressBar = Math.round(audio.currentTime / audio.duration * 100);
    $("#playbackBar .progressBarBG #progress").css('width', progressBar + "%");
}
function formatTime(seconds){
    var allSeconds = Math.round(seconds);
    var minutes = Math.floor(allSeconds / 60);

    var seconds = allSeconds - (minutes * 60);
    var addZero = (seconds <10)? "0" : "";
    return minutes+":"+addZero+seconds;
}
function loadpage(url){
    var encodeUrl = encodeURI(url);
    history.pushState(null,null,url);
    $("#mainContent").load(encodeUrl);
    $("body").scrollTop(0);
}

function TempSongsAlbum(url){
    loadpage(url);
    $("#mainContent").css("visibility",'hidden');
    $("#mainLoader").css("visibility",'visible');
    const promise1 = new Promise(function(resolve, reject) {
        setTimeout(resolve, 1000, 'delay');
    });
    const promise3 = getTempSongsAlbum();
    Promise.all([promise1, promise3]).then(function(values) {
        tempList = values[1];
        $("#mainContent").css("visibility",'visible');
        $("#mainLoader").css("visibility",'hidden');

    }).catch((err) => {console.log(err)});
    // function getTempSongsAlbum(){
    //
    //     $id = getUrlParameter("id");
    //
    //     return new Promise((resolve, reject) => {
    //         $.ajax('includes/ajax/tempSongs.php',
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
}
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
}
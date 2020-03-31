var mouseDown = false;
var currentlySongs;
var shuffleSongs;
var tempList;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var timer;
$(document).on("change", "select.playlist", function(){

    var playlistId = $(this).val();
    var songId = $(this).prev(".songId").val();
    $.post("AjaxCalls/addSongToPlaylist.php",{songId:songId, playlistId:playlistId}).done(function(response){
        var returnedData = JSON.parse(response);
       if(returnedData['status'] === 1){
           toastr.success(returnedData['message'], 'Success');
       }else{
           toastr.error(returnedData['message'], 'Error');
       }
       closeOptionMenu();
    });
});
function deleteSongFromPlaylist(button, playlistId){
    console.log(playlistId);
    var songId =$(button).prevAll(".songId").val();
    $.post("AjaxCalls/removeSongFromPlaylist.php",{songId:songId, playlistId:playlistId}).done(function(response){
        var returnedData = JSON.parse(response);
        if(returnedData['status'] === 1){
            toastr.success(returnedData['message'], 'Success');
        }else{
            toastr.error(returnedData['message'], 'Error');
        }

        loadpage('playlist.php?id='+ playlistId);
        console.log(playlistId);
    });
}
$(document).click(function(click){


    var target = $(click.target);

    if(!target.hasClass("item") && !target.hasClass("optionButton")){
          closeOptionMenu();
    }
});
$(window).scroll(function(){

    closeOptionMenu();
});

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
    if(timer != null){
        clearTimeout(timer);
    }
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
function createPlaylist(){
    var popOut = prompt('Please enter the name of your playlist');
    if(popOut != null){
        $.post("AjaxCalls/createNewPlaylist.php", {name:popOut}).done(function(response){

            loadpage("yourMusic.php");

        })
    }
}
function deletePlaylist($id){
    var popOut = confirm('Are you sure to delete this playlist?');
    if(popOut != null){
        $.post("AjaxCalls/deletePlaylist.php?id="+$id, {name:popOut}).done(function(response){

            loadpage("yourMusic.php");

        })
    }
}

function openOptionMenu(button) {

    var songId = $(button).prevAll(".songId").val();

    var menu = $(".optionMenu");

    menu.find('.songId').val(songId);
    var menuWidth = menu.width();

    var scrollTop = $(window).scrollTop(); //Distance from top of window to top of document
    var elementOffset = $(button).offset().top; //Distance from top of document

    var top = elementOffset - scrollTop;
    var left = $(button).position().left;


    menu.css({"top": top + "px", "left": left+ "px", "display": "inline"});
}
function closeOptionMenu() {

    var optionMenuElement = $(".optionMenu");
    if(optionMenuElement.css("display") != "none"){
        optionMenuElement.css("display", "none")
    }

}
function updateEmail(className){
    var emailVal = $("."+className).val();
    $.post("AjaxCalls/changeEmail.php",{email : emailVal}).done(function(response){
        var returnedData = JSON.parse(response);
        if(returnedData['status'] == '0'){
            $("."+className).nextAll(".message").text(returnedData['message']['email'] );

        }else{
            $("."+className).nextAll(".message").text(returnedData['message'] );
        }
    });
}
function updatePassword(oldPassword, newPassword, confirmPassword){
    var oldPasswordVal = $("."+oldPassword).val();
    var newPasswordVal = $("."+newPassword).val();
    var confirmPasswordVal = $("."+confirmPassword).val();
    console.log(confirmPasswordVal);
    $.post("AjaxCalls/updatePassword.php",{oldPassword : oldPasswordVal, newPassword : newPasswordVal, confirmPassword : confirmPasswordVal}).done(function(response){
        var returnedData = JSON.parse(response);
        console.log(returnedData);
        if(returnedData['status'] === '0'){
            $("."+oldPassword).nextAll(".oldPasswordMessage").text(returnedData['message']['oldPassword'] );
            $("."+newPassword).nextAll(".newPasswordMessage").text(returnedData['message']['newPassword'] );
            $("."+confirmPassword).nextAll(".confirmPasswordMessage").text(returnedData['message']['confirmPassword'] );

        }else{
            $("."+confirmPassword).nextAll(".confirmPasswordMessage").text(returnedData['message'] );
        }
    });
}


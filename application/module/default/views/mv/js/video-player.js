$(document).ready(function () {

    $playcount = 1;
    $('#play-pause-btn').click(function () {
        $playcount++;
        if ($playcount % 2 != 0) {
            $(this).removeClass("play");
            $(this).addClass("pause");
            $("video")[0].play();
            updateProgressBar();
        }
        else {
            $(this).removeClass("pause");
            $(this).addClass("play");
            $("video")[0].pause();
        }

    })


    player = document.getElementById('video-element');
    player.addEventListener('timeupdate', updateProgressBar, false);
    //progressBar = document.getElementById('progress-bar');
    //$('video').on('timeupdate', updateProgressBar, false);

    function updateProgressBar() {
        var percentage = Math.floor((100 / $("video")[0].duration) * $("video")[0].currentTime);
        // console.log(percentage);
        $("#progress-bar").val(percentage);
        $("#progress-bar").html(percentage + '% played');

        curmins = Math.floor($("video")[0].currentTime / 60);
        cursecs = Math.floor($("video")[0].currentTime - curmins * 60);
        durmins = Math.floor(($("video")[0].duration) / 60);
        dursecs = Math.floor($("video")[0].duration - durmins * 60);
        if (curmins < 10) {
            curmins = "0" + curmins;
        }
        if (cursecs < 10) {
            cursecs = "0" + cursecs;
        }
        if (dursecs < 10) {
            dursecs = "0" + dursecs;
        }
        if (durmins < 10) {
            durmins = "0" + durmins;
        }
        $("#timer").html(curmins + ":" + cursecs);
        $("#length").html(durmins + ":" + dursecs);
        if (percentage >= 100) {
            $("#play-pause-btn").removeClass("pause");
            $("#play-pause-btn").addClass("play");
        }
    }

    $("#progress-bar").click(function (e) {
        var percent = e.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        e.target.value = Math.floor(percent / 100);
        e.target.innerHTML = $(this).value + '% played';
    })

    $("#volume-bar").click(function(e){
        player.volume = e.target.value;
    })

    $("#btn-fullscreen").click(function () {
        if (player.requestFullscreen)
            if (document.fullScreenElement) {
                document.cancelFullScreen();
            } else {
                player.requestFullscreen();
            }
        else if (player.msRequestFullscreen)
            if (document.msFullscreenElement) {
                document.msExitFullscreen();
            } else {
                player.msRequestFullscreen();
            }
        else if (player.mozRequestFullScreen)
            if (document.mozFullScreenElement) {
                document.mozCancelFullScreen();
            } else {
                player.mozRequestFullScreen();
            }
        else if (player.webkitRequestFullscreen)
            if (document.webkitFullscreenElement) {
                document.webkitCancelFullScreen();
            } else {
                player.webkitRequestFullscreen();
            }
        else {
            alert("Fullscreen API is not supported");

        }
    })


})
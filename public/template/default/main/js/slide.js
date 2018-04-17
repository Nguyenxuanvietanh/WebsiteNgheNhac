$(document).ready(function(){

    var stt = 0;
    firstImage = $(".slide img:first").attr("stt");
    lastImage = $(".slide img:last").attr("stt");

    $(".slide img").each(function(){
        if($(this).is(':visible')){
            stt = $(this).attr("stt");
        }
    })

    $("#next").click(function(){
        next = ++stt;
        if(next == lastImage){
            stt = firstImage - 1;
        }
        $(".slide img").hide();
        $(".slide img").eq(next).show();
        $(".small-image li").removeClass("active");
        $(".small-image li").eq(next).addClass("active");
    });

    $("#prev").click(function(){
        prev = --stt;
        if(prev == firstImage -1){
            stt = lastImage;
        }
        $(".slide img").hide();
        $(".slide img").eq(prev).show();
        $(".small-image li").removeClass("active");
        $(".small-image li").eq(prev).addClass("active");
    });

    setInterval(function(){
        $("#prev").click();
    }, 2000);
})
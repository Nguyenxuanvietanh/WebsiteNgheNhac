$(document).ready(function(){
    $('#bhvn').addClass('active');
    $('#listhq').css('display','none');
    $('#listam').css('display','none');

    $('#bham').click(function(){
        $(this).addClass('active');
        $('#bhvn').removeClass('active');
        $('#bhhq').removeClass('active');
        $('#listvn').css('display','none');
        $('#listhq').css('display','none');
        $('#listam').css('display','block');
    })

    $('#bhvn').click(function(){
        $(this).addClass('active');
        $('#bham').removeClass('active');
        $('#bhhq').removeClass('active');
        $('#listam').css('display','none');
        $('#listhq').css('display','none');
        $('#listvn').css('display','block');
    })

    $('#bhhq').click(function(){
        $(this).addClass('active');
        $('#bhvn').removeClass('active');
        $('#bham').removeClass('active');
        $('#listvn').css('display','none');
        $('#listam').css('display','none');
        $('#listhq').css('display','block');
    })

//////////////////////////////////////////////////////
    $('#vdvn').addClass('active');
    $('#listvd-hq').css('display','none');
    $('#listvd-am').css('display','none');

    $('#vdam').click(function(){
        $(this).addClass('active');
        $('#vdvn').removeClass('active');
        $('#vdhq').removeClass('active');
        $('#listvd-vn').css('display','none');
        $('#listvd-hq').css('display','none');
        $('#listvd-am').css('display','block');
    })

    $('#vdvn').click(function(){
        $(this).addClass('active');
        $('#vdam').removeClass('active');
        $('#vdhq').removeClass('active');
        $('#listvd-am').css('display','none');
        $('#listvd-hq').css('display','none');
        $('#listvd-vn').css('display','block');
    })

    $('#vdhq').click(function(){
        $(this).addClass('active');
        $('#vdvn').removeClass('active');
        $('#vdam').removeClass('active');
        $('#listvd-vn').css('display','none');
        $('#listvd-am').css('display','none');
        $('#listvd-hq').css('display','block');
    })
    
});


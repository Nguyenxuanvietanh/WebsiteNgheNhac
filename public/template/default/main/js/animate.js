
$(function () {

    setInterval(function () {
        $('.slide').css({ 'transition': 'background 2s linear 1s', 'background': 'url(' + get_random(arr) + ')' });
    }, 8000);

    var $li = $('.small-image ul li');
    var arr = [];
    for (var i = 0; i < $li.length; i++) {
        var c = $li[i].id;
        var img_src = $('#' + c + ' img').attr('src');
        arr.push(img_src);
    }
    get_random = function (list) {
        return list[Math.floor((Math.random() * list.length))];
    }
    $('.slide').css({ 'background': 'url(' + get_random(arr) + ')' });
    //console.log(get_random(arr));

    // for (var i = 0; i < arr.length; i++) {
    //     //console.log(arr);

    // }

    $li.hover(function () {
        var i = $li.index(this);
        var c = $li[i].id;
        var img_src = $('#' + c + ' img').attr('src');
        //console.log(img_src);
        $('.slide').css({ 'transition': 'background 2s linear 0.5s', 'background': 'url(' + img_src + ')' });
    })
})


var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var players=[],
    iframes = $(".carousel__iframe");

function onYouTubePlayerAPIReady() {
    for (var i = 0; i < iframes.length; i++) {
        var iframeItem = iframes[i];

        players[i] = new YT.Player(iframeItem, {
            suggestedQuality: 'hd720'
        });
    }
}
$(function() {
    $("#video_carousel").owlCarousel({
        items: 1,
        singleItem: true,
        loop:true,
        navigation: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        navigationText: ["", ""],
        afterAction: function() {
            for (var i = 0; i < players.length; ++i) {
                players[i].pauseVideo();
            }
            $(".backdrop").show();
        }
    });
    $(".backdrop").click(function() {
        var i = $(this).hide().index('.backdrop');
        players[i].playVideo();
    });
});
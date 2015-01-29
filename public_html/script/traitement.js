/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* ************************* INSCRIPTION ************************************ */
function showPwd()
{
    var tbx_pwd = document.getElementById('tbx_pwd');
    var ckb_show_pwd = document.getElementById('ckb');

    if (ckb_show_pwd.checked)
    {
        tbx_pwd.type = "text";
    }
    else
    {
        tbx_pwd.type = "password";
    }
    tbx_pwd.focus();
}
/* **************************** SOUND *************************************** */
function loadSong(elt, e) {
    if (!e)
        var e = window.event;
    document.getElementById("player").src = elt.href;
    document.getElementById("player").load();
    document.getElementById("player").play();
    return false;
}
window.onload = function() {
    links = document.getElementById("playlist").getElementsByTagName("a");
    for (var i = 0; i < links.length; i++) {
        links[i].onclick = function(e) {
            return loadSong(this, e);
        };
    }
};

$("input[type=button]").click(function() {
    var $target = "media/video/media1" + $(this).attr("rel");
    var $vid_obj = _V_("div_video");

    // hide the current loaded poster
    $("img.vjs-poster").hide();

    $vid_obj.ready(function() {
        // hide the video UI
        $("#div_video_html5_api").hide();
        // and stop it from playing
        $vid_obj.pause();
        // assign the targeted videos to the source nodes
        $("video:nth-child(1)").attr("src", $target + ".mp4");
        $("video:nth-child(1)").attr("src", $target + ".ogv");
        $("video:nth-child(1)").attr("src", $target + ".webm");
        // replace the poster source
        $("img.vjs-poster").attr("src", $content_path + $target + ".jpg").show();
        // reset the UI states
        $(".vjs-big-play-button").show();
        $("#div_video").removeClass("vjs-playing").addClass("vjs-paused");
        // load the new sources
        $vid_obj.load();
        $("#div_video_html5_api").show();
    });
});

$("input[rel='01']").click();
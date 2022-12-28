$(document).ready(function(){
    
})

$(document).on('click','.mute-btn', function(){
    let muted = $("video").prop('muted');
    $("video").prop('muted',!muted);
})

function showThumbnail(){
    $(".preview-video .thumbnail").toggle();
    $(".preview-video .preview").toggle();
}

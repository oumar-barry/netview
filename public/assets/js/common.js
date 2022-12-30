$(document).ready(function(){
    
})

$(window).on('scroll', function(){
    let isScrolled = $(this).scrollTop() >  3.5 * ($('.menu').height());
    $(".menu").toggleClass('active',isScrolled);


})

$(document).on('click','.mute-btn', function(){
    let muted = $("video").prop('muted');
    $("video").prop('muted',!muted);
})

function showThumbnail(){
    $(".preview-video .thumbnail").toggle();
    $(".preview-video .preview").toggle();
}

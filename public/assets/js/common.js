$(document).ready(function(){
    $("#go-back").on('click', () => window.history.back());  
   
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

function showUpNext(){
    $(".upnext-container").addClass('in');
}

function watch(videoId){
    window.location.href = `${SITE_URL}/watch/${videoId}`;
}

function initVideo(videoId){
    startHidingMenu()
    staredWatching(videoId)
    updateVideoProgress(videoId)
    
}

function startHidingMenu(){
    let timer;
    
    timer = setTimeout(() => {
        $(".top-bar").fadeOut();
    }, 2000)
    
    $(document).on('mousemove click ','.video-container', function(){
        clearTimeout(timer);
        $(".top-bar").fadeIn();
        timer = setTimeout(() => {
            $(".top-bar").fadeOut();
        }, 2000)
    })
}

function staredWatching(videoId){
    $.post(`${SITE_URL}/watch/startedWatching/${videoId}`)
}

function updateVideoProgress(videoId){
    let interval;
    $("video").on('playing', function(e){
        interval = setInterval(() => {
            let data = {
                currentTime: e.target.currentTime
            }

            $.post(`${SITE_URL}/watch/updateVideoProgress/${videoId}`,data)

        },3000);

    }).on('ended', function(e){
        $.post(`${SITE_URL}/watch/setToFinished/${videoId}`, (response) => console.log(response))
        window.clearInterval(interval);
        
    });
}

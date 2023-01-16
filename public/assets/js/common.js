let searchTimer;
let muted = localStorage.mute ? localStorage.getItem('mute') : true
$(document).ready(function(){

    $("#go-back").on('click', () => window.history.back());  

    $("#search").on('keyup', function(event){
        clearTimeout(searchTimer)
        if(event.keyCode === 8 && $(this).val().trim() === '' ){
            $(".results").html('')
            return;
        }
        searchTimer = setTimeout(() => {
            let term = $("#search").val()
            if(term.trim() !== ''){
                search(term)
            } else {
                $(".results").html('')
            }
        }, 500)

    });
})

$(window).on('scroll', function(){
    let isScrolled = $(this).scrollTop() >  3.5 * ($('.menu').height());
    $(".menu").toggleClass('active',isScrolled);


})

$(document).on('click','.mute-btn', function(){
    let muted = $("video").prop('muted');
    $("video").prop('muted',!muted);
    $(this).find('i').toggleClass('fa-volume-xmark fa-volume-up');
    localStorage.setItem('mute',JSON.stringify($("video").prop('muted')))
})

function search(term){
    $.post(`${SITE_URL}/Pages/makeSearch`,{term}, (response) => {
        if(response !== ''){
            $(".results").html(response);
        } else {
            $(".results").html('<span> Aucun résultat trouvé </span>');
        }
    })
}

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
    resumePlaying(videoId)
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

function resumePlaying(videoId){
    $.post(`${SITE_URL}/watch/resumePlaying/${videoId}`, (duration) => {
        if(duration ==''){
            console.log(duration)
            return;
        }
    
        $(".video-container video").on('canplay', function(){
            this.currentTime = duration
            $(".video-container video").off('canplay')
        }) 
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

function replay(){
    let video = $(".video-container video")[0];
    video.currentTime = 0;
    video.play();
    $(".upnext-container").removeClass('in');
}


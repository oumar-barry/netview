<?php 

    class VideoProvider {

        public function __construct($video){
            $this->model = new Video_model();
            $this->video = $video;

        }

        public function create(){
            $title = $this->video->getTitle();
            $seasonAndEpisode  = $this->video->getSeasonAndEpisode();
            $upNextVideo = $this->upNextVideo();
            $filePath = $this->video->getFilePath();
            return "<div class='video-container' >
                        <div class='top-bar'>
                            <span id='go-back' > <i class='fa-solid fa-arrow-left'></i> </span>
                            <span> $title, $seasonAndEpisode  </span>
                        </div>

                        $upNextVideo
                        <video autoplay='autoplay' controls onended='showUpNext()' >
                            <source src='".URL_ROOT."/$filePath' type='video/mp4' > </source>
                        </video>

                    </div>";
        }

        public function upNextVideo(){
            $upNext = $this->model->getUpNext($this->video);
            $upNextVideo = new Video($upNext->id);
            
            return "<div class='upnext-container'>
                        <div class=''>
                            <span onClick='replay()' class='replay'> <i class='fa-solid fa-rotate-left'></i> </span>
                            <div class='video'> 
                                <h4> Continuer ".$upNextVideo->getSeasonAndEpisode()."</h4>
                                <span class='title'>".$upNextVideo->getTitle()." </span>
                                <button onClick='watch(\"".$upNextVideo->getid()."\")'  class='play-btn' > <i class='fa-solid fa-play'></i> Play  </button>
                            </div>
                        </div>
                    </div>";

        }


    }

?>
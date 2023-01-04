<?php 

    class Watch extends Controller {

        public function __construct(){

        }

        public function index($videoId = null){
            if((int) $videoId == 0) return $this->redirect('/');
            $video = new Video($videoId);
            $video->incrementViews();
            $videoProvider = new VideoProvider($video);
            
            $data = [
                'title' => $video->getTitle(),
                'videoPlayer' => $videoProvider->create(),
                'video' => $video,
                'hideMenu' => true
            ];


            $this->view('Pages/watch',$data);



        }

        public function updateVideoProgress($videoId = ''){
            
            if($videoId && ((int) $videoId != 0) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')){
                
                $video = new Video($videoId);
                $video->updateProgress($_POST['currentTime']);


            }

        }

        public function startedWatching($videoId = ''){
            if($videoId && ((int) $videoId != 0)){
                $video = new Video($videoId);
                $video->addIntoProgress();
            }

        }

        public function setToFinished($videoId = ''){
            if($videoId && ((int) $videoId != 0) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')){
                
                $video = new Video($videoId);
                $video->setToFinished();


            }
        }


    }

    


?>
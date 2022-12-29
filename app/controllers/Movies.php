<?php 

    class Movies extends Controller {

        public function __construct(){
            if(!User::isLoggedIn()) return $this->redirect('/');
        }

        public function index(){
            
            $preview = new VideoPreview();

            $data = [
                'title' => 'Movies',
                'moviePreview' => $preview->createMoviePreview(),
                'moviesCategories' => $preview->moviesCategories()
            ];

            $this->view('Pages/movies',$data);
        }

    }


?>
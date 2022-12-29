<?php 

    class Shows extends Controller {

        public function __construct(){
            // Redirect the user if he's not logged in 
            if(!User::isLoggedin()) return $this->redirect('/');
        }

        public function index(){
            $preview = new VideoPreview();

            $data = [
                'title' => 'Tv shows',
                'videoPreview' => $preview->createShowPreview(),
                'tvShowsCategories' => $preview->tvShowsCategories()
            ];

            $this->view('Pages/shows',$data);
        }

    }


?>
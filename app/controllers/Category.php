<?php 
    class Category extends Controller {

        public function __construct(){
            
        }


        public function index($categoryId = 1){
            $categoryId = (int) $categoryId != 0 ? $categoryId : 1;
            $preview = new VideoPreview();
            $data = [
                'title' => 'Categories',
                'videoPreview' => $preview->createCategoryPreview($categoryId) ,
                'categoryVideos' => $preview->showCategory($categoryId)
            ];

            $this->view('Pages/category',$data);

        }


    }


?>
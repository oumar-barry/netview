<?php 
    
    class VideoPreview{

        public function __construct(){
            $this->model = new VideoPreview_model();
        }

        public function create($entity = ''){
            if(!$entity){
                $entity = $this->getRandomEntity()[0];
            }

            return "<div class='preview-video'  >
                        <div class='description'>
                            <h4> ".$entity->getName()." </h4>
                            <div class='controls'>
                               <button class='play-btn' >PLAY </button>
                               <button class='mute-btn' > MUTE </button>
                            </div>
                        </div>

                        <img  class='thumbnail' src='".URL_ROOT."/".$entity->getThumbnail()."' style='display: none;'  alt='Thumbail image'  />
                        <video class='preview' muted autoplay onended='showThumbnail()' >
                            <source src='".URL_ROOT."/".$entity->getPreview()."' > </source>
                        </video>
            
            </div>";


        }

        public function createShowPreview(){
            $entity = (new EntityProvider)->getTvShowsEntities(null,1)[0];
            // Display a message if there is no entity available
            
            return $this->create($entity);
        }

        public function createMoviePreview(){
            $entity = (new EntityProvider)->getMoviesEntities(null,1)[0];
            // Display a message if there is no entity available
            
            return $this->create($entity);
        }

        public function createCategoryPreview($categoryId){
            $entity = (new EntityProvider())->getEntities($categoryId,1);

            // Display a message if there is no entity aailable 
            return $this->create($entity);
        }

        public function tvShowsCategories(){
            $categoriesHtml = "";
            $categories = $this->model->getCategories();
            foreach($categories as $category){
                $categoriesHtml .= $this->createCategoryHtml($category,null,false,true);
            }

            return "<div class='categories-container'>
                        <h2 class='head'> Series TV </h2>
                        ".$categoriesHtml."
                    </div>";
        }

        public function moviesCategories(){
            $categoriesHtml = "";
            $categories = $this->model->getCategories();
            foreach($categories as $category){
                $categoriesHtml .= $this->createCategoryHtml($category,null,true,false);
            }

            return "<div class='categories-container'>
                        <h2 class='head'> Films </h2>
                        ".$categoriesHtml."
                    </div>";   
        }

        public function showAllCategories(){
            $categoriesHtml = "";
            $categories = $this->model->getCategories();
            foreach($categories as $category){
                $categoriesHtml .= $this->createCategoryHtml($category,null,true,true);
            }

            return "<div class='categories-container'>
                        ".$categoriesHtml."
                    </div>";
            
        }

        public function showCategory($categoryId){
            $categoryHtml = "";
            $category = $this->model->getCategory($categoryId);
            
            $categoryHtml .= $this->createCategoryHtml($category,null,true,true);
            
            return "<div class='categories-container nowrap'>
                        $categoryHtml
                    </div>";   
        }

        public function getRandomEntity(){
            return (new EntityProvider())->getEntities(null,1); 
        }

        public function createCategoryHtml($category,$title,$movies,$shows){
            $title = $title ? $title : $category->name;
            if($movies && $shows){
                $entities = (new EntityProvider())->getEntities(null,30);
            } else if($movies){
                $entities  = (new EntityProvider)->getMoviesEntities(null,30);
            } else if($shows) {
                $entities  = (new EntityProvider)->getTvShowsEntities(null,30);
            } else {
                $entities = [];
            } 

            $entitiesHtml = "";
            foreach($entities as $entity){
                $entitiesHtml .= $this->createEntityPreviewSquare($entity);
            }

            return "<div class='category' >
                        <h3> <a href='".URL_ROOT."/category/".$category->id."'> $title </a> </h3> 
                        <div class='entities'>
                            ".$entitiesHtml."
                        </div>
                    <div>";
            

        }

        public function createEntityPreviewSquare($entity){
            $id = $entity->getId();
            $thumbnail = $entity->getThumbnail();
            $name = $entity->getName();
            
            return "<a href='".URL_ROOT."/entity/$id' class='entity-square' >
                        <img src='".URL_ROOT."/".$thumbnail."' alt='$name' title='$name'  />
                    </a>";

        }






    }



?>
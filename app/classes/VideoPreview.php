<?php 
    
    class VideoPreview{

        public function __construct(){
            $this->model = new VideoPreview_model();
        }

        public function create($entity = null){
            if(!$entity){
                $entity = $this->getRandomEntity()[0];
                
            }

            return "<div class='preview-video'  >
                        <div class='description'>
                            <h4> ".$entity->getName()." </h4>
                            <div class='controls'>
                               <button class='play-btn' >PLAY </button>
                               <button  class='mute-btn' > MUTE </button>
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
            $entity = $entity ? $entity[0] : null; 
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

        public function showCategory($categoryId, $title = null){
            $categoryHtml = "";
            $category = $this->model->getCategory($categoryId);
            
            $categoryHtml .= $this->createCategoryHtml($category,$title,true,true);
            
            return "<div class='categories-container nowrap'>
                        $categoryHtml
                    </div>";   
        }


        public function showAllSeasons($entity){
            $seasons = $entity->getSeasons();
            $seasonsHtml = "";

            foreach($seasons as $season){
                $currentSeason = $season->getSeasonNumber();
                $episodesHtml = "";
                foreach($season->getEpisodes() as $episode){
                    $episodesHtml .= $this->createEpisodeHtml($episode);
                }

                $seasonsHtml .= "<div class='season'>
                                    <h3 class='' > Saison $currentSeason </h3>
                                    <div class='episodes'>
                                        $episodesHtml
                                    </div>
                                </div>";

            }

            return "<div class='seasons'> 
                            $seasonsHtml
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
            
            return "<a href='".URL_ROOT."/entities/$id' class='entity-square' >
                        <img src='".URL_ROOT."/".$thumbnail."' alt='$name' title='$name'  />
                    </a>";

        }

        public function createEpisodeHtml($video){
            $id = $video->getId();
            $title = $video->getTitle();
            $description = $video->getDescription();
            $filePath = $video->getFilePath();
            $thumbnail = (new Entity($video->getEntityId()))->getThumbnail();
            $duration = $video->getDuration();
            $episode = $video->getEpisode();

            return "<a href='".URL_ROOT."/watch/$id' class='episode'>
                        <div class='thumbnail' >
                            <img src='".URL_ROOT."/$thumbnail'  alt='image of $title ' />
                            <span class='seen'> </span>
                            <span class='duration' > $duration </span>
                        </div>
                        <span class='episode-number' > Episode $episode </span>
                        <span class='title'> $title </span>
                        <span class='description'> $description </span>
                        
                    </a>";

        }






    }



?>
<?php 
    class Entities extends Controller{
    
        public function __construct(){

        }

        public function index($entityId = ''){
            $entityId = (int) $entityId != 0 ? $entityId : 1;
            $entity = new Entity($entityId);
            // Redirect to a 404 page to be done after 
            if(!$entity) return $this->redirect('/pages/browse');
            $preview = new Videopreview();
            
            $data = [
                'title' => $entity->getName(),
                'videoPreview' => $preview->create($entity),
                'allSeasons' => $preview->showAllSeasons($entity),
                'recommendedVideos' => $preview->showCategory($entity->getCategoryId(), 'Vous pourriez aussi aimer ')
            ];

            $this->view('Pages/entities',$data);

        }

    }

?>
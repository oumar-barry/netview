<?php
    class EntityProvider {

        public function __construct(){
            $this->model = new EntityProvider_model();
        }

        public function getEntities($category,$limit){
            $rows = $this->model->getEntities($category,$limit);
            $entities = [];
            foreach($rows as $row){
                $entities[] = new Entity($row);
            }
            return $entities;
            
        }

        public function getTvShowsEntities($category,$limit){
            $rows = $this->model->getTvShowsEntities($category,$limit);
            $entities = [];
            foreach($rows as $row){
                $entities[] = new Entity($row);
            }
            return $entities;
        }


        public function getMoviesEntities($category,$limit){
            $rows = $this->model->getMoviesEntities($category,$limit);
            $entities = [];
            foreach($rows as $row){
                $entities[] = new Entity($row);
            }
            return $entities;
        }

    }


?>
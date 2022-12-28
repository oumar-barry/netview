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

    }


?>
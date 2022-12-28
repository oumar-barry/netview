<?php

    class Entity {

        public function __construct($input){
            $this->model = new EntityProvider_model();

            if(!is_object($input)){
                $input = $this->model->getEntityById($input);
            }

            $this->data = $input;
        }

        public function getId(){
            return $this->data->id;
        }

        public function getName(){
            return $this->data->name;
        }

        public function getThumbnail(){
            return $this->data->thumbnail;
        }

        public function getPreview(){
            return $this->data->preview;
        }

        public function getCategoryId(){
            return $this->data->categoryId;
        }

    }


?>
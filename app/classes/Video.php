<?php

    class Video {
        
        public function __construct($input){
            $this->model = new Video_model();

            if(!is_object($input)){
                $row = $this->model->getVideoById($input);
                if(!$row) return redirect('/');    
                $this->data = $row;
            } else {
                $this->data = $input;
            }

            
            
            
        }

        public function getId(){
            return $this->data->id;
        }

        public function getTitle(){
            return $this->data->title;
        }

        public function getDescription(){
            return $this->data->description;
        }

        public function getFilePath(){
            return $this->data->filePath;
        }

        public function isMovie(){
            return $this->data->isMovie == 1;
        }

        public function getUploadDate(){
            return $this->data->uploadDate;
        }

        public function getReleaseDate(){
            return $this->data->releaseDate;
        }

        public function numViews(){
            return $this->data->views;
        }

        public function getSeason(){
            return $this->data->season;
        }

        public function getSeasonAndEpisode(){
            if(!$this->isMovie()){
                $text = "S".$this->getSeason()." E".$this->getEpisode();
            } else {
                $text = "";
            }
            return  $text;
        }

        public function incrementViews(){
            $views = $this->model->incrementViews($this->getId());
            $this->data->views = $this->data->views + 1;
        }

        public function getEpisode(){
            return $this->data->episode;
        }

        public function getDuration(){
            return $this->data->duration;
        }

        public function getEntityId(){
            return $this->data->entityId;
        }

        public function updateProgress($time){
            $id = $this->getId();
            $username = $_SESSION['username'];
            return $this->model->updateProgress($id,$username,$time);
        }

        public function addIntoProgress(){
            $id = $this->getId();
            $username = $_SESSION['username'];
            return $this->model->addIntoProgress($id,$username);
        }

        public function setToFinished(){
            $id = $this->getId();
            $username = $_SESSION['username'];
            return $this->model->setToFinished($id,$username);
        }

    



    }


?>
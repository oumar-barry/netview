<?php

    class Video {

        public function __construct($video){
            $this->data = $video;
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

        public function getEpisode(){
            return $this->data->episode;
        }

        public function getDuration(){
            return $this->data->duration;
        }

        public function getEntityId(){
            return $this->data->entityId;
        }



    }


?>
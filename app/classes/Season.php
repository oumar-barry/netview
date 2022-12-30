<?php 
    class Season {
        
        public function __construct($season,$episodes){
            $this->season = $season;
            $this->episodes = $episodes;
        }

        public function getSeasonNumber(){
            return $this->season;
        }

        public function getEpisodes(){
            return $this->episodes;
        }

    }

?>
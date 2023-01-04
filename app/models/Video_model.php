<?php 

    class Video_model {

        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function getVideoById($id){
            $this->db->query("SELECT * FROM videos WHERE id = :id ");
            $this->db->bind('id',$id);
            $a = $this->db->singleRow();
            
            return $this->db->singleRow();
        }

        public function incrementViews($videoId){
            $this->db->query("UPDATE videos SET views = views + 1 WHERE id = :id ");
            $this->db->bind('id',$videoId);
            $this->db->execute('close');
        }

        public function getUpNext($video){
            
            if($video->isMovie()){
                $query = "SELECT videos.id as id FROM categories INNER JOIN entities ON categories.id = entities.categoryId INNER JOIN videos ON entities.id = videos.entityId AND videos.isMovie = 1 AND videos.entityId != :entityId ORDER BY views DESC LIMIT 1 ";
                
                $this->db->query($query);
                $this->db->bind('entityId',$video->getEntityId());
                $result = $this->db->singleRow();

            } else {
                $query = "SELECT id FROM videos WHERE id != :id AND ((season = :season AND episode > :episode) OR (season > :season and episode >= 1)) AND entityId = :entityId ORDER BY season ASC, episode ASC LIMIT 1";
            
                $this->db->query($query);
                $this->db->bind('id',$video->getId());
                $this->db->bind('season',$video->getSeason());
                $this->db->bind('episode',$video->getEpisode());
                $this->db->bind('entityId',$video->getEntityId());
                $result = $this->db->singleRow();

                if(!$result){
                    $query = "SELECT videos.id as id FROM categories INNER JOIN entities ON categories.id = entities.categoryId INNER JOIN videos ON entities.id = videos.entityId AND videos.isMovie = 0 AND videos.entityId != :entityId ORDER BY season ASC, episode ASC views DESC LIMIT 1 ";

                    $this->db->query($query);
                    $this->db->bind('entityId',$video->getEntityId());
                    $result = $this->db->singleRow();

                }


            }

            return $result;
            

        }


        public function updateProgress($id, $username,$time){
            $this->db->query("UPDATE videoProgress SET progress = :time WHERE username = :username AND videoId = :videoId ");
            
            $this->db->bind(':time',$time);
            $this->db->bind('username',$username);
            $this->db->bind('videoId',$id);
            $this->db->execute('close');

        }

        public function addIntoProgress($id,$username){
            $this->db->query("SELECT id FROM videoProgress WHERE username = :username AND videoId = :videoId ");

            $this->db->bind('username',$username);
            $this->db->bind('videoId', $id);
            $result = $this->db->singleRow();

            if(!$result){
                $this->db->query("INSERT INTO videoProgress (username,videoId) VALUES (:username, :videoId) ");

                $this->db->bind('username',$username);
                $this->db->bind('videoId', $id);
                $this->db->execute('close');

            }

        }

        public function setToFinished($id,$username){
            $this->db->query("UPDATE videoProgress SET finished = 1, progress = 0 WHERE username = :username AND videoId = :videoId ");
            
            $this->db->bind('username',$username);
            $this->db->bind('videoId',$id);
            $this->db->execute('close');   
        }

    }

?>
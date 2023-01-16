<?php
    class VideoPreview_model{
        protected $db;
        
        public function __construct(){
            $this->db = new Database();
        }

       

        public function getCategories(){
            $this->db->query("SELECT * FROM categories ");
            return $this->db->multipleRows();
        }

        public function getCategory($id){
            $this->db->query("SELECT * FROM categories WHERE id = :id ");
            $this->db->bind('id',$id);
            return $this->db->singleRow();
        }

        public function hasStartedWatching($entity){
            $query = "SELECT videoProgress.videoId as id  FROM entities INNER JOIN videos ON entities.id = videos.entityId INNER JOIN videoProgress ON videoProgress.videoId = videos.id WHERE videoProgress.username = :username AND entities.id = :id ORDER BY id DESC LIMIT 1  ";

            $this->db->query($query);
            $this->db->bind('username',$_SESSION['username']);
            $this->db->bind('id',$entity->getId());
            $row = $this->db->singleRow();
            return $row ? $row->id : null ;
        }

        
        
        
        

    }


?>
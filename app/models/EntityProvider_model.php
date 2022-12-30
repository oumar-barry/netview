<?php
    class EntityProvider_model{
        protected $db;
        
        public function __construct(){
            $this->db = new Database();
        }

        public function getEntities($category,$limit){
            $query = "SELECT * FROM entities ";
            $query .= $category ? "WHERE categoryId = :category " : "";
            $query .= "ORDER BY RAND() LIMIT :limit";

            $this->db->query($query);
            
            if($category) $this->db->bind('category',$category);
            $this->db->bind('limit',$limit);
            return $this->db->multipleRows();
            

        }

        public function getTvShowsEntities($category,$limit){
            $query = "select distinct(entities.id) as id, entities.name as name, entities.thumbnail as thumbnail , entities.preview as preview, entities.categoryId as categoryId from videos inner join entities on entities.id = videos.entityId  WHERE videos.isMovie = 0 ";
            
            $query .= $category ? " AND entities.categoryId = :id " : '';
            $query .= "ORDER BY RAND() LIMIT :limit";
            
            $this->db->query($query);
            $this->db->bind('limit',$limit);
            if($category) $this->db->bind('id',$category);
            return $this->db->multipleRows();
            
            
        }

        public function getMoviesEntities($category,$limit){
            $query = "select distinct(entities.id) as id, entities.name as name, entities.thumbnail as thumbnail , entities.preview as preview, entities.categoryId as categoryId from videos inner join entities on entities.id = videos.entityId  WHERE videos.isMovie = 1 ";
            
            $query .= $category ? " AND entities.categoryId = :id " : '';
            $query .= "ORDER BY RAND() LIMIT :limit";
            
            $this->db->query($query);
            $this->db->bind('limit',$limit);
            if($category) $this->db->bind('id',$category);
            return $this->db->multipleRows();   
        }

        public function getEntityById($input){
            $this->db->query("SELECT * FROM entities WHERE id = :id ");
            $this->db->bind('id',$input);
            return $this->db->singleRow();
        }

    

        
        
        
        

    }


?>
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

        public function getEntityVideos($id){
            $query = "SELECT videos.id as id, videos.title as title, videos.description as description, videos.filePath as filePath, videos.isMovie as isMovie, videos.uploadDate as uploadDate, videos.releaseDate as releaseDate, videos.views as views, videos.duration as duration, videos.season as season, videos.episode as episode, videos.entityId as entityId

            FROM videos INNER JOIN entities ON videos.entityId = entities.id WHERE videos.isMovie = 0 and videos.entityId = :id ORDER BY season, episode ASC  ";

            $this->db->query($query);
            $this->db->bind('id',$id);
            return $this->db->multipleRows();
        }

    

        
        
        
        

    }


?>
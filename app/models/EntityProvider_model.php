<?php
    class EntityProvider_model{
        protected $db;
        
        public function __construct(){
            $this->db = new Database();
        }

        public function getEntities($category,$limit){
            $query = "SELECT * FROM entities ";
            $query .= $category ? "WHERE category = :category " : "";
            $query .= "ORDER BY RAND() LIMIT :limit";

            $this->db->query($query);
            
            if($category) $this->db->bind('category',$category);
            $this->db->bind('limit',$limit);
            return $this->db->multipleRows();
            

        }

        public function getEntityById($input){
            $this->db->query("SELECT * FROM entities WHERE id = :id ");
            $this->db->bind('id',$input);
            return $this->db->singleRow();
        }

        
        
        
        

    }


?>
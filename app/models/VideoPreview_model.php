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

        
        
        
        

    }


?>
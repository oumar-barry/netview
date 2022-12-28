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

        
        
        
        

    }


?>
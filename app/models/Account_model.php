<?php
    class Account_model{
        protected $db;
        
        public function __construct(){
            $this->db = new Database();
        }
        
        
        public function is_in_use($table,$field,$value){
            $this->db->query("SELECT id FROM $table  WHERE $field = :value ");
            $this->db->bind('value',$value);
            return $this->db->singleRow();
        }

        public function insertData($data){
            extract($data);
            $this->db->query("INSERT INTO users (firstname, lastname,username, email, password ) 
                                        VALUES (:fn,:ln,:un,:em,:pw)  ");
            
            $password = password_hash($password,PASSWORD_BCRYPT);
            
            $this->db->bind('fn',$firstname);
            $this->db->bind('ln',$lastname);
            $this->db->bind('un',$username);
            $this->db->bind('em',$email);
            $this->db->bind('pw',$password);
            
            $id = $this->db->lastInsertId();

            $this->db->query("SELECT * FROM users WHERE id = :id ");
            $this->db->bind('id',$id);
            return $this->db->singleRow();
        }

        public function findUserByCredential($credential){
            $this->db->query("SELECT * FROM users WHERE username = :credential OR email = :credential");
            $this->db->bind('credential',$credential);
            return $this->db->singleRow();
        }

    }


?>
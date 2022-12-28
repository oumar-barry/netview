<?php
    class User{
        public function __construct(){

        }

        public static function isLoggedIn(){
            return isset($_SESSION['username']);
        }


    }


?>
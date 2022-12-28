<?php 

    class Core {
        private $currentController = 'Pages';
        private $currentMethod = 'index';
        private $param = [];

        public function __construct(){
            $url = $this->getUrl();

            
            if(isset($url[0])){
                if(file_exists('../app/controllers/'.ucfirst($url[0]).'.php')){
                    $this->currentController = ucfirst($url[0]);
                    unset($url[0]);
                } else {
                    $this->currentController = $this->currentController;
                }
            }
            
            
            require "../app/controllers/". $this->currentController .".php";
            
            $this->currentController = new $this->currentController;


            if(isset($url[1])){
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // le code ci-dessous inclure lorsqu'oo ne veut avoir un seul point d'entré
            // qui est la page de connexion seulement ( pas d'autres méthodes )
            // pour le controller Page

            /* if(($this->currentController instanceof PageController) && ($this->currentMethod == 'index')){
                $this->currentMethod = "connexion";
            } */
            
            $this->param = $url ? array_values($url) : [];
                
            call_user_func_array([$this->currentController,$this->currentMethod],$this->param);    
                
            
        }

        public function getUrl(){
            
            if(isset($_GET['url'])){
                $url = $_GET['url'];
                $url = rtrim($url,'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;

            }
        }

    }





?>
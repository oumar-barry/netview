<?php 
    class Pages extends Controller{

        public function __construct(){
            
        }

        public function index(){
            $this->browse();
        }

        public function register(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                extract($_POST);

                $data = [
                    "firstname" => echap($firstname),
                    "lastname" => echap($lastname),
                    "username" => echap($username),
                    "email" => echap($email),
                    "password" => echap($password),
                    "password_conf" => echap($password_conf)
                ];

                $account = new Account();
                [$errors, $success,$user] = $account->create($data);
                $data = array_merge($data,$errors);
                
                if($success) {
                    $this->createSession($user);
                    $this->redirect('/Pages/browse');
                } else {
                    return $this->view('Pages/register',$data);
                }

                
            } else {
                
                $data = [
                    "firstname" => "",
                    "lastname" => "",
                    "username" => "",
                    "email" => "",
                    "password" => "",
                    "password_conf" => ""
                ];

                $this->view('Pages/register',$data);
            }


            
        }

        public function browse(){
            if(!User::isLoggedIn()) return $this->redirect('/Pages/login');
            
            $preview = new VideoPreview();
            
            $data = [
                'videoPreview' => $preview->create(),
                'allCategories' => $preview->showAllCategories()
            ];
            
            $this->view("Pages/browse",$data);
            
        }

        public function login(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                extract($_POST);
                
                $data = [
                    'credential' => echap($credential),
                    'password' => $password
                ];

                $account = new Account();
                [$errors,$success,$user] = $account->login($data);

                if($success){
                    $this->createSession($user);
                    $this->redirect('/');
                } else {
                    $data = array_merge($data,$errors);
                    $this->view('Pages/login',$data);
                }


            } else {

                $data = [
                    'credential' => '',
                    'password' => ''
                ];

                $this->view('Pages/login',$data);

            }
            
        }

        public function logout(){
            $this->destroySessions();
        }

    }


?>
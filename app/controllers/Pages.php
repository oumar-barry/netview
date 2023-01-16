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
                    'title' => 'Register',
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
                    'title' => 'Register',
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
                'title' => 'Explorer',
                'videoPreview' => $preview->create(),
                'allCategories' => $preview->showAllCategories()
            ];
            
            $this->view("Pages/browse",$data);
            
        }

        public function search(){
            $data = [
                'title' => 'Recherche'
            ];

            $this->view('Pages/search',$data);
        }

        public function makeSearch(){
            if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
                $results = (new EntityProvider())->getSearchEntities($_POST['term']);
                if($results){
                    $preview = new VideoPreview();
                    $entitiesHtml = "";
                    foreach($results as $result){
                        $entitiesHtml .= $preview->createEntityPreviewSquare($result);
                    }

                    echo $entitiesHtml;

                } else {
                    echo "";
                }
                
                //echo json_encode($results);
                

            }

        }

        public function login(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                extract($_POST);
                
                $data = [
                    'title' => 'Login',
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
                    'title' => 'Register',
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
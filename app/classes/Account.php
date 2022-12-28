<?php 
    class Account{
        protected $data = [];
        public function __construct(){
            $this->model = new Account_model();
            $this->errors = [];
            
        }

        public function create($data){
            $this->data = $data;
            extract($data);

            $this->validateFirstName($firstname);
            $this->validateLastName($lastname);
            $this->validateUserName($username);
            $this->validateEmail($email);
            $this->validatePassword($password,$password_conf);
            
            
            if(empty($this->errors)){
                $user = $this->model->insertData($this->data);
                return [$this->errors, 1,$user];
            } else {
                return [$this->errors, 0,null];
            }

            

            
        }

        public function login($data){
            
            if(is_empty($data)){
                $this->errors['credential_err'] = "Veuillez remplir tous les champs ";
                return [$this->errors,0,null];
            }

            $user = $this->model->findUserByCredential($data['credential']);
            
            if($user && password_verify($data['password'],$user->password)){
                return [null,1,$user];
            } else {
                $this->errors['credential_err'] = "Pseudo / email out mot de passe incorrect ";
                return [$this->errors,0,null];
            }

             
        }

        protected function validateFirstName($fn){
            if(mb_strlen($fn) < 3 || mb_strlen($fn) > 25){
                $this->errors['firstname_err'] = "Le prénom doit être entre 3 et 25 characters "; 
            }
        }

        protected function validateLastName($ln){
            if(mb_strlen($ln) < 3 || mb_strlen($ln) > 25){
                $this->errors['lastname_err'] = "Le nom doit être entre 3 et 25 characters "; 
            } 
        }

        protected function validateUserName($un){
            if(mb_strlen($un) < 3 || mb_strlen($un) > 25){
                $this->errors['username_err'] = "Le pseudo doit être entre 3 et 25 characters "; 
                return;
            }   

           $usernameExists = $this->model->is_in_use('users','username',$un);
           if($usernameExists){
                $this->errors['username_err'] = "Ce pseudo est déjà utilisé "; 
                return;
           }


        }

        protected function validateEmail($em){
            if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
                $this->errors['email_err'] = "Le format de l'email est invalid ";
                return;
            } 

           $emailExists = $this->model->is_in_use('users','email',$em);
           if($emailExists){
                $this->errors['email_err'] = "Adresse email déjà utilisée  "; 
                return;
           }
        }

        protected function validatePassword($pw,$pw_conf){
            if(mb_strlen($pw) < 2) {
                $this->errors['password_err'] = "Mot de passe trop court minimum 3 caractères ";
                return;
            }

            if($pw != $pw_conf){
                $this->errors['password_err'] = "Les deux mots de passe sont différents ";
                return;
            }   

        }







    }

?>
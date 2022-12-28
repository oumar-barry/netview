<?php 

	class Controller{

		protected function model($model){
			if(file_exists('../app/models/'.$model.'.php')){
				require '../app/models/'.$model.'.php';
				return new $model;
				
			}

		}

		


		protected function view($view, $data = []){
			if(file_exists('../app/views/'.$view.'.php')){
				
				extract($data);
				require '../app/views/'.$view.'.php';
				
			} else {
						die("Cette page n'existe pas");
			}
		}

		public function redirect($url){
			header('Location: '.URL_ROOT.$url);
			exit();	
		}

		public function createSession($user){
			$_SESSION['username'] = $user->username;
		}

		public function destroySessions(){
			session_destroy();
			$_SESSION = [];
			$this->redirect("/");
		}

		



	}









 ?>
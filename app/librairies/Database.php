<?php 

	
	class Database {

		private $server = SERVER;
		private $db_name = DB_NAME;
		private $db_user = DB_USER;
		private $db_pass = DB_PASS;
		private $db_handler;
		private $db_stmt;
		private $error;

		public function __construct(){
			
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_PERSISTENT => true
				 
			];

			$dsn = 'mysql:localhost;host='.$this->server.';dbname='.$this->db_name;

			try{

					$this->db_handler = new PDO($dsn, $this->db_user, $this->db_pass);


			} catch(PDOException $e){
				$this->error = $e->getMessage();
				die($this->error);
			}


		}

		//Permet d'initier une requête 
		public function query($query){
			$this->db_stmt = $this->db_handler->prepare($query);
		}

		// permet de lier un paramètre nommé à une valeur
		public function bind($param,$value,$type = null){
			if(is_null($type)){
				
				switch(true){
					case is_int($value) : $type = PDO::PARAM_INT;
							break;

					case is_bool($value) : $type = PDO::PARAM_BOOL;
							break;

					case is_string($value) : $type = PDO::PARAM_STR;
							break;
					default:
						$type = PDO::PARAM_NULL;

				}
			

			}

			return $this->db_stmt->bindValue($param,$value,$type);



		}


		// Prevent us closing the cursor every time
		public function execute($action = ''){
			$query =  $this->db_stmt->execute();
			if($action == 'close'){
				$this->closeCursor();
			}
			return $query;
		}

		public function singleRow($format = ''){
			$this->execute();
			$row =  $format == 'assoc' ? $this->db_stmt->fetch(PDO::FETCH_ASSOC) : $this->db_stmt->fetch(PDO::FETCH_OBJ);
			$this->closeCursor();
			return $row;
		}

		public function multipleRows($format = ''){
			$this->execute();
			$rows =  $format == 'assoc' ? $this->db_stmt->fetchAll(PDO::FETCH_ASSOC) : $this->db_stmt->fetchAll(PDO::FETCH_OBJ);
			$this->closeCursor();
			return $rows;
		}

		public function rowCount(){
			$this->execute();
			$row = $this->db_stmt->rowCount();
			$this->closeCursor();
			return $row;
		}

		public function lastInsertId(){
			$this->execute();
			return $this->db_handler->lastInsertId();
		}

		public function closeCursor(){
			return $this->db_stmt->closeCursor();
		}

		
		// Use this function to debug your SQL requests to see what is wrong
		public function errors(){
			$this->execute();
			return $this->db_stmt->errorInfo();
		}




		





		





	





































	}













 ?>
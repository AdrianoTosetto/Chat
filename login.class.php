 <?php
 	//require('UserMapper.class.php');
 	class Login{
 		
 		private $usuario;
 		private $userMapper; //Tipo: userMapper

 		public function __construct($usuario){
 			$this->usuario = $usuario;
 			$this->userMapper = new UserMapper($usuario);
 		}
 		public function logar(){
 			return $this->userMapper->mapAndCheckRow();
 		}

 		public function getUser(){
 			return $this->user;
 		}
 	}
 ?>
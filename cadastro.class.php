<?php
	require_once('UserMapper.class.php');
	require_once('Model/usuario.class.php');
	class Cadastro{
		private $user;  //Tipo Usuario
		private $userMapper; //Tipo UserMapper

		public function __construct($usuario){
			$this->user = $usuario;
		}
		public function cadastrar(){
			$this->userMapper = new UserMapper($this->user);
	 		if(!$this->userMapper->mapAndCheckRow()) {
	 			$this->userMapper->mapAndInsert();
	 			setcookie("userLogin",$this->user->getLogin(),time()+ 60*60*60);
	 			return true;
	 		}
	 		return false;
		}
	}
?>
<?php
	class Usuario {
		private $nome;
		private $login;
		private $senha;
		private $URLPic;
		private $id;
		private $status;
		private $usageStatus;
		
		public function __construct($nome, $login, $senha){
			$this->nome  = $nome;
			$this->login = $login;
			$this->senha = $senha;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function setLogin($login){
			$this->login = $login;
		}
		public function setSenha($senha){
			$this->senha = $senha;
		}
		public function getNome(){
			return $this->nome;
		}
		public function getLogin(){
			return $this->login;
		}
		public function getSenha(){
			return $this->senha;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}
		public function setUrlPic($path){
			$this->URLPic = $path;
		}
		public function getURLPic(){
			return $this->URLPic;
		}
		public function setStatus($status) {
			$this->status = $status;
		}
		public function getStatus(){
			return $this->status;
		}
		public function setUsageStatus($usageStatus){
			$this->usageStatus = $usageStatus;
		}
		public function getUsageStatus(){
			return $this->usageStatus;
		}
	}
?>
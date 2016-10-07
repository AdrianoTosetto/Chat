<?php
require("database.class.php");
	class Mapper(){
		
		private $dataBase;
		public function __construct(){
			$this->dataBase = new DataBase("usuarios","root","");
		}
	}
?>
 <?php
 	class File{
 		private $name;
 		private $path;
 		private $size;

 		public function __construct($name,$size){
 			$this->name = $name;
 			$this->size = $size;
 		}
 		public function setName($name){
 			$this->name = $name;
 		}
 		public function setSize($size){
 			$this->size = $size;
 		}
 		public function getName(){
 			return $this->name;
 		}
 		public function getSize(){
 			return $this->size;
 		}
 	}

 ?>
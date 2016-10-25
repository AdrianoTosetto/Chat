 <?php
 	class TextFileMapper implements iFileMapper{
 		
 		private $instance;

 		private function __construct(){}

 		public function getInstance(){
 			if(self::$instance === null):
 				self::$instance = new TextFileMapper(); 
 			endif;

 			return self::$instance;
 		}

 		public function mapAndMoveToDirectory($imageFile,$maxImageSize,$imageExtensionsAllowed,$file){
 			
 		}
 	}
 ?>
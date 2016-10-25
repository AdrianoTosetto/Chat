 <?php
 	require_once('libraries/PHP-Libraries/WideImage/WideImage.php');
 	require_once('FileMapper.interface.php');
 	class ImageMapper implements iFileMapper{
 		
 		private static $instance;

 		public function getInstance(){
 			if(self::$instance === null):
 				self::$instance = new ImageMapper();
 			endif;

 			return self::$instance;
 		}

 		public function __construct(){}			
 		public function mapAndMoveToDirectory($imageFile,$maxImageSize,$imageExtensionsAllowed,$file){
 			$ext = (explode(".",$imageFile['name']))[1];
 			if($imageFile['size'] > 200*1024):
 				return false;
 			else:
 				if(in_array($ext,["png","jpg"]) || true):
 					echo $file->getName();
 					if(move_uploaded_file($imageFile['tmp_name'],"media/images/".$file->getName())):
 						$image = WideImage::load("media/images/".$file->getName());
 						$image = $image->resize(250,250);
 						$image->saveToFile("media/images/small/".$file->getName());
 						return true;
 					endif;
 				endif;
 			endif;
 		}
 	}
 ?>
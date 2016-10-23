 <?php
 	require_once('libraries/PHP-Libraries/WideImage/WideImage.php');
 	class ImageMapper{
 		
 		private $maxImageSize; //em kb
 		private $imageExtensionsAllowed;
 		private $imageFile; //$_FILES do php
 		private $instance;

 		public function getInstance(){
 			if(self::$instance === null):
 				self::$instance = new ImageMapper();
 			endif;

 			return self::$instance;
 		}

 		public function __construct($imageFile,$maxSize, $extensions){
 			$this->imageFile    = $imageFile;
 			$this->maxImageSize = $maxSize * 1024;
 			$this->imageExtensionsAllowed = $extensions;
 		}			
 		public function mapAndMoveToDirectory($path,$imageName){
 			$ext = (explode(".",$this->imageFile['name']))[1];
 			if($this->imageFile['size'] > $this->maxImageSize):
 				return false;
 			else:
 				if(in_array($ext,$this->imageExtensionsAllowed) || true):
 					$imageURL = $path."/".$imageName;
 					if(move_uploaded_file($this->imageFile['tmp_name'],$path."/".$imageName)):
 						$image = WideImage::load($path."/".$imageName);
 						$image = $image->resize(250,250);
 						$image->saveToFile($path."/small/".$imageName);
 					endif;
 				endif;
 			endif;
 		}
 	}
 ?>
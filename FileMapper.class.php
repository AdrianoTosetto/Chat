 <?php
 	interface FileMapper{
 		
 		function mapAndMoveToDirectory($imageFile,$maxImageSize,$imageExtensionsAllowed,$path,$imageName);
 	}
 ?>
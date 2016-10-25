 <?php
 	 require_once('ChatManager.php');
 	 require_once('Model/usuario.class.php');
 	 require_once('Model/message.class.php');
 	 require_once('Model/date.class.php');
 	 require_once('ImageMapper.php');
 	 require_once('Model/File.class.php');
 	 require_once('database.class.php'); //retirar depois
	 class HTTPRequestManager{

	 	private static $instance;

	 	private $chatManager;

	 	private function __construct(){
	 		$this->chatManager = ChatManager::getInstance();
	 	}

	 	public function getInstance(){
	 		if(self::$instance === null):
	 			self::$instance = new HTTPRequestManager();
	 		endif;

	 		return self::$instance;
	 	}

	 	public function translateHTTPRequests(){
	 		if(isset($_GET['newStatus']) and isset($_GET['userId'])):
	 			$newStatus = $_GET['newStatus'];
	 			$id = $_GET['userId'];
	 			$user = new Usuario(null, null, null);
	 			$user->setId($id);
	 			$this->chatManager->updateStatus($user, $newStatus);
	 		endif;
	 		if(isset($_GET['idSent']) && isset($_GET['idReceived'])):
	 			$userSent = new Usuario(null, null, null);
	 			$userSent->setId($_GET['idSent']);
	 			$userReceived = new Usuario(null, null, null);
	 			$userReceived->setId($_GET['idReceived']);
	 			$html = $this->chatManager->loadConversation($userSent, $userReceived);
	 			echo $html;
	 		endif;
	 		if(isset($_GET['text']) && isset($_GET['idUserSent']) && isset($_GET['idUserReceived'])):
	 			$text = $_GET['text'];
	 			$idUserSent = $_GET['idUserSent'];
	 			$idUserReceived = $_GET['idUserReceived'];
	 			$message = new Message(null, $text, $idUserSent, $idUserReceived, null);
	 			if(isset($_FILES['upload_files'])) {
	 				echo "entrou";
	 				if(move_uploaded_file($_FILES['upload_file']['tmp_name'], "media/images/" . $_FILES['upload_file']['name'])){
	 					$path = $_FILES['image']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
	 					$imageName = "media/images/".$_GET['idUserSent'].'-'.$_GET['idUserReceived'].time().$ext;
	 					$message->setMessage(null);
	 				}
	 			}
	 			$this->chatManager->insertMessage($message);
	 		endif;
	 		if(isset($_POST['text']) && isset($_POST['idUserSent']) && isset($_POST['idUserReceived'])):
	 			$message = new Message(null, $_POST['text'], $_POST['idUserSent'],$_POST['idUserReceived'], null);
	 			$path = $_FILES['upload_file']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
	 			$imageURL = $_POST['idUserSent'] . '-'.$_POST['idUserReceived']. '-' . time() . '.' .$ext;
	 			$this->chatManager = ChatManager::getInstance();
	 			$this->chatManager->moveImageToDirectory($_FILES['upload_file'],200,["png"],"media/images",$imageURL);
	 			//$mapper = new ImageMapper($_FILES['upload_file'],200,[".png"]);
	 			//$mapper->mapAndMoveToDirectory("media/images",$imageURL);
	 			$message->setImageURL("media/images/".$imageURL);
	 			$this->chatManager->insertMessage($message);
	 		endif;
	 		if(isset($_GET['getStatusById'])):
	 			$user = new Usuario(null,null,null);
	 			$user->setId($_GET['getStatusById']);
	 			echo $this->chatManager->getStatus($user);
	 			
	 		endif;
	 		if(isset($_GET['userId']) && $_GET['usageStatus']):
	 				$user = new Usuario(null,null,null);
	 				$user->setId($_GET['userId']);
	 				echo $user->getId();
	 				$this->chatManager->updateUsageStatus($user,$_GET['usageStatus']);
	 		endif;
	 	}
	 }
	 $httpRM = HTTPRequestManager::getInstance();
	 $httpRM->translateHTTPRequests();
?>
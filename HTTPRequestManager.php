 <?php
 	 require_once('ChatManager.php');
 	 require_once('usuario.class.php');
 	 require_once('message.class.php');
 	 require_once('date.class.php');
	 class HTTPRequestManager{
	 	private $chatManager;

	 	public function __construct(){
	 		$this->chatManager = new ChatManager();
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
	 			$this->chatManager->insertMessage($message);
	 		endif;
	 		if(isset($_GET['getStatusById'])) {
	 			$user = new Usuario(null,null,null);
	 			$user->setId($_GET['getStatusById']);
	 			echo $this->chatManager->getStatus($user);
	 			
	 		}
	 	}
	 }
	 $httpRM = new HTTPRequestManager();
	 $httpRM->translateHTTPRequests();
?>
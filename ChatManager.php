<?php
	require_once('UserMapper.class.php');
	require_once('Model/date.class.php');
	require_once('Model/message.class.php');
	require_once('database.class.php');
	require_once('Model/usuario.class.php');
	require_once('MessageMapper.class.php');
	require_once('Model/File.class.php');

	class ChatManager {

		private $userMapper;
		public  $messageMapper;
		private $fileMapper;
		private static $singletonLog;
		public function getInstance(){
			if(self::$singletonLog === null):
				self::$singletonLog = new ChatManager();
			endif;
			return self::$singletonLog;
		}
		private function __construct(){}
		public function insertMessage($message){ //$message => Tipo Message
			$this->messageMapper = MessageMapper::getInstance();
			$this->messageMapper->mapAndInsert($message);
			//MapeadorMensagem->insert($message);
			//echo $message->getText();
			//$dataBase = new DataBase("usuarios","root","");
			//$dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data"],
			//				 [$message->getText(),$message->getUserSentId(),$message->getUserReceivedId(), ""]);
		}
		public function moveImageToDirectory($files,$maxSize,$extensions,$path,$imageName){
			$this->fileMapper = null; //Mapeador vai mapear um arquivo
			
			if(strcmp((explode(".",$files['name']))[1],"txt") != 0):
					$imageFile = new File($imageName,null);
					$this->fileMapper = ImageMapper::getInstance();
			endif;
			if(strcmp((explode(".",$files['name']))[1],"txt") == 0):
					$imageFile = new File($imageName,null);
					$this->fileMapper = TextFileMapper::getInstance();
			endif;
			
			$this->fileMapper->mapAndMoveToDirectory($files,200,["png"],$imageFile);
		}
		public function loadConversation($userSent, $userReceived){
			$this->userMapper = new UserMapper($userSent);
			$messages = new ArrayObject();
			$messages = $this->userMapper->mapAndGetConversation($userReceived);
			$html = "";
			for($i = 0; $i < count($messages); $i++){
				if($userSent->getId() == $messages[$i]->getUserSentId() && $userReceived->getId() == $messages[$i]->getUserReceivedId()){
						if(!is_null($messages[$i]->getImageURL())):
							$url = $messages[$i]->getImageURL();
							$html .= '<div class="sender"><img width="250" height="250" src="'.$url.'"/></div>';
						else:
							$html .= '<div class="sender">'.$messages[$i]->getText()."</div>";
						endif;
				}
				if($userReceived->getId() == $messages[$i]->getUserSentId() && $userSent->getId()== $messages[$i]->getUserReceivedId()){
						if(!is_null($messages[$i]->getImageURL())):
							$url = $messages[$i]->getImageURL();
							$html .= '<div class="receiver"><img width="250" height="250" src="'.$url.'"/></div>';
						else:
							$html .= '<div class="receiver">'.$messages[$i]->getText()."</div>";
						endif;
				}
			}
			return $html;
		}
		public function updateStatus($user, $newStatus){
			$this->userMapper = new UserMapper($user);
			$this->userMapper->mapAndSetStatus($newStatus);
		}
		public function getFriends($user) {
			$this->userMapper = new UserMapper($user);
			return $this->userMapper->mapAndGetFriends($user);
		}
		public function getIdByUser($user){ //Retorna um inteiro
			$this->userMapper = new UserMapper($user);
			return $this->userMapper->mapAndGetIdByUser();
			//$rows = $this->dataBase->getRows("usuarios",["id"], ["Login","Senha"],[$user->getLogin(), $user->getSenha()], "=");
			//return $rows[0]['id'];
		}
		public function getStatus($user){
			$this->userMapper = new UserMapper($user);
			return $this->userMapper->mapAndGetStatusByUser();	
		}
		public function updateUsageStatus($user,$newUsageStatus){
			$this->userMapper = new UserMapper(null);
			$this->userMapper->mapAndUpdateUsageStatus($user,$newUsageStatus);
		}
	}
?>
<?php
	require_once('UserMapper.class.php');
	require_once('date.class.php');
	require_once('message.class.php');
	require_once('database.class.php');
	require_once('usuario.class.php');
	require_once('MessageMapper.class.php');
	class ChatManager{

		private $userMapper;
		private $messageMapper;
		public function __construct(){}
		public function insertMessage($message){ //$message => Tipo Message
			$this->messageMapper = new MessageMapper($message);
			$this->messageMapper->mapAndInsert();
			//MapeadorMensagem->insert($message);
			//echo $message->getText();
			//$dataBase = new DataBase("usuarios","root","");
			//$dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data"],
			//				 [$message->getText(),$message->getUserSentId(),$message->getUserReceivedId(), ""]);
		}
		public function loadConversation($userSent, $userReceived){
			$this->userMapper = new UserMapper($userSent);
			$messages = new ArrayObject();
			$messages = $this->userMapper->mapAndGetConversation($userReceived);
			$html = "";
			for($i = 0; $i < count($messages); $i++){
				if($userSent->getId() == $messages[$i]->getUserSentId() && $userReceived->getId() == $messages[$i]->getUserReceivedId()){
					$html .=  '<div class="sender">'.$messages[$i]->getText()."</div>";
				}
				if($userReceived->getId() == $messages[$i]->getUserSentId() && $userSent->getId()== $messages[$i]->getUserReceivedId()){
						$html .= '<div class="receiver">'.$messages[$i]->getText()."</div>";
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
	}
?>
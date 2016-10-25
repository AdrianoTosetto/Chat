<?php
	require_once("database.class.php");
	require_once("Model/usuario.class.php");
	class UserMapper{
		private $dataBase;
		private $user;
		public function __construct($user){
			$this->dataBase = DataBase::getInstance();
			$this->dataBase->connect();
			$this->user = $user;
		}
		public function mapAndInsert(){
			$this->dataBase->connect();
			$this->dataBase->insertRow("usuarios",
	 				["Nome","Login","Senha","ProfilePicture"],
	 				[$this->user->getNome(),$this->user->getLogin(),$this->user->getSenha(),"media/profile/default.png"]);
		}
		public function mapAndCheckRow(){ //return boolean
			return $this->dataBase->rowExists("usuarios",
										["Login","Senha"],
										[$this->user->getLogin(), 
										 $this->user->getSenha()]);
		}
		public function mapAndGetConversation($otherUser){
			$html = "";
			//$messages = $this->dataBase->getConversation($userSent->getId(), $userReceived->getId());
			$messagesArray = new ArrayObject();
			$messages = $this->dataBase->getRows2("mensagem",["*"], 
						[["id_user_sent","id_user_received"],
						["id_user_sent","id_user_received"]], 
						[[$this->user->getId(),$otherUser->getId()],[$otherUser->getId(),$this->user->getId()]],["=","="],
						["OR"]);
			for($i = 0; $i < count($messages); $i++) {
				   		$m = new Message($messages[$i]['id'],
										 $messages[$i]['text'],
										 $messages[$i]['id_user_sent'],
										 $messages[$i]['id_user_received'],
										 $messages[$i]['data']);
						$m->setImageURL($messages[$i]['image_url']);
						if(strlen($m->getImageURL()) == 0):
							$m->setImageURL(null);
						endif;
						$messagesArray->append($m);
			}
			return $messagesArray;
		}
		public function mapAndSetStatus($status) {
			$this->dataBase->updateRow("Usuarios", ["status"], [$status], $this->user->getId());
		}
		public function mapAndGetIdByUser(){
			$rows = $this->dataBase->getRows("usuarios",["id"], ["Login","Senha"],
										[$this->user->getLogin(), $this->user->getSenha()], "=");
			return $rows[0]['id'];
		}
		public function mapAndGetFriends(){
			$lines = $this->dataBase->getRows("usuarios",["*"], ["Login","Senha"], 
										[$this->user->getLogin(),
										$this->user->getSenha()], "!=");
			$friends = Array();
			$index = 0;
			for($i = 0; $i < count($lines); $i++){
				$userAux = new Usuario($lines[$i]['Nome'],$lines[$i]['Login'],$lines[$i]['Senha']);
				$userAux->setId($lines[$i]['Id']);
				$friends[$index] = $userAux;
				$index++;
			}
			return $friends;
		}
		public function mapAndGetStatusByUser(){
			$rows = $this->dataBase->getRows("usuarios",["status"],["id"],[$this->user->getId()],"=");
			return $rows[0]['status'];
		}
		public function mapAndUpdateUsageStatus($user,$newUsageStatus){
			$this->dataBase->updateRow("usuarios",["usageStatus"],[$newUsageStatus],$user->getId());
		}
	}
?>
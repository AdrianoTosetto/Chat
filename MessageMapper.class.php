 <?php
 	require_once('database.class.php');
 	require_once('Model/message.class.php');
 	class MessageMapper{
 		
 		private $dataBase;
 		private $message;
 		public function __construct($m){
 			$this->dataBase = Database::getInstance();
 			$this->dataBase->connect();
 			$this->message = $m;
 		}
 		
 		public function mapAndInsert(){
 			if($this->message->getImageURL() == null):
 				$this->dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data"],
							 [$this->message->getText(),$this->message->getUserSentId(),$this->message->getUserReceivedId(), ""]);
				else:
				$this->dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data","image_url"],
							 [$this->message->getText(),$this->message->getUserSentId(),$this->message->getUserReceivedId(), "",$this->message->getImageURL()]);
			endif;
 		}
 	}
 ?>
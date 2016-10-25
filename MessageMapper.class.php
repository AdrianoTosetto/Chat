 <?php
 	require_once('database.class.php');
 	require_once('Model/message.class.php');
 	class MessageMapper{
 		
 		private $dataBase;
 		private $message;
 		private static $instance;
 		public function __construct($m){
 			$this->dataBase = Database::getInstance();
 			$this->dataBase->connect();
 			$this->message = $m;
 		}
 		public function getInstance(){
 			if(self::$instance === null):
 				self::$instance = new MessageMapper(null);
 			endif;

 			return self::$instance;
 		}
 		public function mapAndInsert($message){
 			if($message->getImageURL() == null):
 				$this->dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data"],
							 [$message->getText(),$message->getUserSentId(),$message->getUserReceivedId(), ""]);
				else:
				$this->dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data","image_url"],
							 [$message->getText(),$message->getUserSentId(),$message->getUserReceivedId(), "",$message->getImageURL()]);
			endif;
 		}
 	}
 ?>
 <?php
 	require_once('database.class.php');
 	require_once('message.class.php');
 	class MessageMapper{
 		
 		private $dataBase;
 		private $message;
 		public function __construct($m){
 			$this->dataBase = new DataBase("usuarios","root","");
 			$this->dataBase->connect();
 			$this->message = $m;
 		}

 		public function mapAndInsert(){
 			$this->dataBase->insertRow("mensagem", ["text","id_user_sent","id_user_received","data"],
							 [$this->message->getText(),$this->message->getUserSentId(),$this->message->getUserReceivedId(), ""]);
 		}
 	}
 ?>
 <?php
 	class Message{
 		private $id;
 		private $text;
 		private $userSentId; //Id do usuario que mandou
 		private $userReceivedId; //Id do usuario que recebeu
 		private $date;

 		public function __construct($id, $text, $userSentId, $userReceivedId, $date){
 			$this->id = $id;
 			$this->text = $text;
 			$this->userSentId = $userSentId;
 			$this->userReceivedId = $userReceivedId;
 			$this->date = $date;
 		}
 		public function getId(){
 			return $this->id;
 		}
 		public function getText(){
 			return $this->text;
 		}
 		public function getUserSentId(){
 			return $this->userSentId;
 		}
 		public function getUserReceivedId(){
 			return $this->userReceivedId;
 		}
 		public function getDate(){
 			return $this->date;
 		}
 	}
 ?>
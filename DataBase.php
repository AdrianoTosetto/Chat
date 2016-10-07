 <?php
 	class DataBase{
 		private $pass;
 		private $root;
 		private $dbname;
 		private $pdoConnection;
 		function __construct($dbname, $root, $pass){ //Construtor
 			$this->pass   = $pass;
 			$this->root   = $root;
 			$this->dbname = $dbname;
 		}
 		public function connect() {
 			$sqlConnectString       = "mysql:dbhost=localhost;dbname=".$this->dbname;
 			$this->pdoConnection    = new PDO($sqlConnectString, $this->root, $this->pass);
 		}
 		/*public function insertUser($name, $login, $pass) {
 			$command = "Insert into Usuarios(Nome, Login, Senha) VALUES('{$name}', '{$login}', '{$pass}')";
 			$this->pdoConnection->exec($command);
 		}*/
 		public function insertUser($user) {
 			$name  = $user->getNome();
 			$login = $user->getLogin();
 			$pass  = $user->getSenha();
 			$command = "Insert into Usuarios(Nome, Login, Senha) VALUES('{$name}', '{$login}', '{$pass}')";
 			$this->pdoConnection->exec($command);
 		}
 		public function validateUser($user){
 			$login = $user->getLogin();
 			$pass  = $user->getSenha();
 			$tb = $this->pdoConnection->prepare("Select id from usuarios where login=:login and senha=:senha");
 			$tb->bindParam(":login",$login,PDO::PARAM_STR);
 			$tb->bindParam(":senha",$pass, PDO::PARAM_STR);
 			$tb->execute();
 			$l = $tb->fetch(PDO::FETCH_ASSOC);
 			$tb = null;
 			return !empty($l);
 		}
 		public function removeUser($id){}

 	}
 	//$mydb = new DataBase("Usuarios", "root","");
 	//$mydb->connect();
 	//$mydb->validateUser("login","senha");
 	//$pdo = connect();
 	//$command = "Insert into Usuarios(Nome, Login, Senha) VALUES('adriano', 'tosetto', 'senha')";
 	//$pdo->exec($command);
 ?>
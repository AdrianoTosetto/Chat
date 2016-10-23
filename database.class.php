 <?php
 	class DataBase{
 		private $pass;
 		private $root;
 		private $dbname;
 		private $pdoConnection;
 		private static $instance;

 		private function __construct($dbname="usuarios", $root="root", $pass=""){ //Construtor
 			$this->pass   = $pass;
 			$this->root   = $root;
 			$this->dbname = $dbname;
 		}
 		public function getInstance(){
 			if(self::$instance === null):
 				self::$instance = new DataBase();
 			endif;

 			return self::$instance;
 		}
 		public function connect() {
 			$sqlConnectString       = "mysql:dbhost=localhost;dbname=".$this->dbname;
 			$this->pdoConnection    = new PDO($sqlConnectString, $this->root, $this->pass);
 		}
 		public function getRows2($table, $selectItems, $fields, $valuesToBeTested, $op1, $op2){
 			$sql  = "select * from {$table} where ";
 			$sql .= "(";
 			for($i = 0; $i < count($fields); $i++){
 				for($j = 0; $j < count($fields[$i]); $j++) {
 					if($j == count($fields[$i]) - 1):
 						$sql .=  $fields[$i][$j] .$op1[$i]."'{$valuesToBeTested[$i][$j]}'";
 					else:
 						$sql .=  $fields[$i][$j] .$op1[$i]."'{$valuesToBeTested[$i][$j]}'"." and ";
 					endif;
 				}
 				$sql .= ")";
 				if(count($op2) > $i)
 					$sql .= " {$op2[$i]} ";
 				if($i != count($fields) - 1)
 				$sql .= "(";
 			}
 			$index = 0;
 			$rows  = Array();
 			$consulta = $this->pdoConnection->query($sql);
 			while($line = $consulta->fetch(PDO::FETCH_ASSOC)):
 				$rows[$index] = $line;
 				$index++;
 				//echo $line['text'];
 			endwhile;
 			return $rows;
 			echo $sql;
 		}
 		public function getRows($table, $selectItems, $fields, $valuesToBeTested, $op){
 			$sql = "select ";
 			$rows = Array();
 			$index = 0;
 			for($i = 0; $i < count($selectItems); $i++):
 				if($i == count($selectItems) - 1):
 					$sql .= " ". $selectItems[$i] . " ";
 				else:
 					$sql .=  " ". $selectItems[$i] + ", ";
 				endif;
 			endfor;
 			$sql .= " from {$table} where ";
 			for($i = 0; $i < count($fields); $i++):
 				if($i == count($fields) - 1):
 					$sql .= $fields[$i] .$op. " '" . $valuesToBeTested[$i] . "'";
 				else:
 					$sql .= $fields[$i] . $op. " '" . $valuesToBeTested[$i] . "' and ";
 				endif;
 			endfor;
 			$consulta = $this->pdoConnection->query($sql);
 			while($line = $consulta->fetch(PDO::FETCH_ASSOC)):
 				$rows[$index] = $line;
 				$index++;
 			endwhile;
 			return $rows;
 		}
 		public function getId($user) {
 			$pass  = $user->getSenha();
 			$login = $user->getLogin(); 
 			$query = "Select id from usuarios WHERE Login = '{$login}' and Senha = '{$pass}'";
 			$aux = $this->pdoConnection->query($query);
 			while(($line = $aux->fetch(PDO::FETCH_ASSOC))) {
 				$id = $line['id'];
 			}
 			return $id;
 		}
 		public function insertRow($table, $fields, $values){
 			$sql = "INSERT into {$table}(";
 			for($i = 0; $i < count($fields); $i++) {
 				if($i != count($fields) - 1):
 					$sql = $sql . $fields[$i] . ",";
 				else:
 					$sql = $sql . $fields[$i]. ")";
 				endif;
 			}
 			$sql = $sql . " Values(";
  			for($i = 0; $i < count($values); $i++):
 				if($i != count($values) - 1):
 					$sql = $sql . "'". $values[$i] . "'" . ",";
 				else:
 					$sql = $sql . "'". $values[$i]."'". ")";
 				endif;
 			endfor;
 			$this->pdoConnection->exec($sql);
 		}
 		public function updateRow($table, $fields, $newValues, $idRow){
 			$sql = "UPDATE {$table} SET ";
 			for($i = 0; $i < count($fields); $i++):
 				if($i == count($fields) - 1):
 					$sql = $sql .  $fields[$i] . " = '" . $newValues[$i] . "'";
 				else:
 					$sql = $sql .  $fields[$i] . " = '" . $newValues[$i] . "', ";
 				endif;
 			endfor;
 			$sql.= " WHERE id = '{$idRow}'";
 			echo $sql;
 			$this->pdoConnection->exec($sql);
 		}
 		public function rowExists($table, $fields, $valuesToBeTested){
 			$rows = Array();
 			$sql = "SELECT * FROM {$table} WHERE ";
 			for($i = 0; $i < count($fields); $i++):
 				if($i == count($fields) - 1):
 					$sql .= $fields[$i] . " = '" . $valuesToBeTested[$i] . "'";
 				else:
 					$sql .= $fields[$i] . " = '" . $valuesToBeTested[$i] . "' and ";
 				endif;
 			endfor;
 			$tb = $this->pdoConnection->prepare($sql);
 			$tb->execute();
 			$l = $tb->fetch(PDO::FETCH_ASSOC);
 			return !empty($l);
 		}
 	}
 	//$mydb   = new DataBase("usuarios","root","");
 	//$mydb->connect();
 	//$rows = $mydb->getRows("usuarios",["id"], ["Login","Senha"],["Tosetto", "senha"], "=");
 	//echo $rows[0]['id'];
 	//echo $rows[1]['text'];
 	//echo count($rows);
 	//$mydb->insertRow("Usuarios", ["Nome","Login","Senha"], ["Daniel", "Boso", "senha4"]);
 ?>
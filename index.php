 <?php
 	require_once('UserMapper.class.php');
   	require_once('cadastro.class.php');
   	require_once('login.class.php');
    require_once('ChatManager.php');
    //require('MessageMapper.class.php');
    $name = $login = $pass = "";
    $usuario = null;
	if(isset($_POST['pass']) && isset($_POST['login']) && isset($_POST['name'])) { 
		$pass     = ($_POST['pass']);
		$name     = ($_POST['name']);
		$login    = ($_POST['login']);
		$nUsuario = new Usuario($name, $login, $pass);
		$nConta   = null;
		$cad      = new Cadastro($nUsuario);
		$mydb   = new DataBase("Usuarios","root","");
		$mydb->connect();
		$usuario  = new Usuario($name, $login, $pass);
		//echo $usuario->getId();
 		if($cad->cadastrar()){
 			echo "Cadastro feito";
 			setcookie("userLogin",$login,time()+ 60*60*60);
 			setcookie("userPass", $pass, time() + 60*60*60);
 			$usuario->setId($mydb->getId($usuario));
 			setcookie("userId", $usuario->getId(), time() + 60*60*60);
 		}else{
 			echo "<h3>Cadastro não aprovado</h3>";
 			echo '<meta http-equiv="refresh" content="3;url=login.php">'; 
 		}
	}
	if(isset($_POST['lLogin']) && isset($_POST['lPass'])) {
		$lLogin = $_POST['lLogin'];
		$lPass  = $_POST['lPass'];
		$mydb   = new DataBase("Usuarios","root","");
		$usuario  = new Usuario(null,$lLogin, $lPass);
 		$mydb->connect();
 		$userId  = $mydb->getId($usuario);
 		$usuario->setId(((new ChatManager())->getIdByUser($usuario)));
 		$login = new Login($usuario);
 		if($login->logar()){
 			setcookie("userLogin",$lLogin,time() + 60*60*60);
 			setcookie("userPass", $lPass, time() + 60*60*60);
 			setcookie("userId", $usuario->getId(), time() + 60*60*60);
 			echo "<h1>Autenticado:".$lLogin."</h1>";
 		}else{
 			echo "<h3>Usuario invalido</h3>";
 			echo '<meta http-equiv="refresh" content="3;url=login.php">'; 
 		}
	}
	if($usuario == null) {
		$usuario = new Usuario(null, $_COOKIE['userLogin'], $_COOKIE['userPass']);
		$usuario->setId($_COOKIE['userId']);
	}
?>


 <html>
 <head>
 	<title></title>
 	<script type="text/javascript" src="libraries/jquery-3.1.0.min.js"></script>
 	<script type="text/javascript" src="js/index.js"></script>
 	<script type="text/javascript" src="js/animations.js"></script>
 	<meta charset="utf-8"/>
 	<link rel="stylesheet" class="text/css" href="style/index.css">
 </head>
 <body>
 <div class="description">
 	<img src="media/profile/default.png" height="100" width="100"/>
 	<div class="text-area">
 		<div class="status"></div>
 	</div>
 </div>
 	<div class="users">
	 	<?php
	 		$db = new DataBase("Usuarios","root","");
	 		$db->connect();
	 		$amigos = (new ChatManager())->getFriends($usuario);
	 		for($i = 0; $i < count($amigos); $i++):
	 	?>
	 		<div class="user" id="<?php echo $amigos[$i]->getId(); ?>">
	 			<img width="50" height="50" src="media/profile/default.png"/>
		 		<div class="user-name"><?php echo $amigos[$i]->getNome(); ?></div>
		 	</div>
	 	<?php
	 		endfor;
	 	?>
 	</div>
 	<a href="logout.php" class="logout-link">Sair</a>
 	<div class = "chat-container" id="<?php echo $usuario->getId();?>" id-friend="">
 		<div class = "chat-head">
 			<div class="friend-name"></div>

 		</div>
 		<div class = "chat-body">
 			
 		</div>
 	<div class="message-area">
 			<button class="send-button">Enviar</button>
 			<textarea class="message-textarea" resizeable="false"></textarea>
 		</div>
 	</div>
 	<div class="management-account">
 		<h4 class="management-account-title">Gerenciamento de Conta</h4>
 		<div class="options">
 			<a href="#" class="update-status">Atualizar status</a>
 			<input type="text" id="statusInput" class="status-input input-hidden"></input>
 			<button class="updateStatus status-button button-hidden" value="Atualizar">Atualizar</button>
 			<a href="#" class="">Trocar foto de usuário</a>

 		</div>
 	</div>
 </body>
 </html>
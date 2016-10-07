 <?php
 	if(isset($_COOKIE['userLogin'])) header("Location: index.php");
 ?>
 <html>
 <head>
 	<title></title>
 	<script type="text/javascript" src="libraries/jquery-3.1.0.min.js"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){
 			var show = false;
 			$('textarea').keypress(function(key){
 				if(key.keyCode == 13){
 					var text = $(this).val();
 					var html = "<div class="+"sender"+">"+text+"</div>";
 					$('.chat-body').append(html);
 					$(this).val('');
 				}
 			});
 			$('.link-change').click(function(){
 				if(!show) {
 					$('.container-sign-in').show(1000);
 					$('.container-sign-up').hide(1000);
 					show = true;
 				}else{
 					$('.container-sign-up').show(1000);
 					$('.container-sign-in').hide(1000);
 					show = false;
 				}
 			});
 			$('#signUpForm').submit(function(){});
 		});
 	</script>
 	<meta charset="utf-8"/>
 	<link type="text/css" href="style/login.css" rel="stylesheet">
 </head>
<body>

  <div class="wrapper">
    <div class="container-sign-up">
    <h3>Cadastre-se</h3>
    <form type="submit"  action="index.php" id="signUpForm" method="post">
      	<input type="text" name="name" placeholder="Nome" required minlength=3 id="name">
      	<input type="text" name="login" placeholder="Login" required minlength=3 id="login">
      	<input type="password" name="pass" placeholder="Senha" required minlength=3 id="pass">
      	<input type="submit" value="Cadastrar">
      	<a href="#" onclick="return false" class="link-change">Entre</a>
      	</form>
    </div>
    <div class="container-sign-in">
    <h3>Entre</h3>
    <form type="submit"  action="index.php" method="post">
      	<input type="text" name="lLogin" placeholder="Login" required minlength=3>
      	<input type="password" name="lPass" placeholder="Senha" required minlength=3>
      	<input type="submit" value="Entrar">
      	<a href="#" onclick="return false" class="link-change">Cadastre-se</a>
     </form>
    </div>
  </div>

</body>
 </body>
 </html>
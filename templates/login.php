<?php

if(isset($_POST)){
	$counter = 0;
	if(isset($_POST['username_login'])){
		$username = $_POST['username_login'];
		$counter++;
	}
	if(isset($_POST['password_login'])){
		$password = $_POST['password_login'];
		$counter++;
	}

	if($counter==2){
		$signature = signin($username, $password);
		if($signature->verif == True){
			$_SESSION['connected'] = true;
			$_SESSION['username'] = $_POST['username_login'];
			$_SESSION['id_user'] = $signature->id;
		}else{
			$counter = 0;
		}
	}else{
		$counter = 0;
	}
}

if(isset($_SESSION['connected'])){
	goPage('/');
}

?>

<div class="box">
	<form class="form" method="post" action="/index.php?page=signin">
		<div class="for-group">
			<label for="username_login" class="coText">Pseudo : </label>
			<input type="text" id="username_login" name="username_login" value="<?php
				if(isset($username)){
					echo $username;
				}
			?>"><br><br>
		</div>
		<div class="for-group">
			<label for="password_login" class="coText">Mot de passe : </label>
			<input type="password" id="password_login" name="password_login"><br><br>
		</div>
		<div class="form-group">
			<button class="btn btnCo">Connexion</button>
		</div>
	</form>
</div>

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
		if(signup($username, $password)){
			$_SESSION
		}
	}
}

?>

<div class="box">
	<form class="form" method="post" action="/login.php">
		<div class="for-group">
			<label for="username_login">pseudo : </label>
			<input type="text" id="username_login" name="username_login">
		</div>
		<div class="for-group">
			<label for="password_login">Mot de passe : </label>
			<input type="password" id="password_login" name="password_login">
		</div>
		<div class="form-group">
			<button class="btn">Connexion</button>
		</div>
	</form>
</div>

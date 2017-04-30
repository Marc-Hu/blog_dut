<?php

if(!isset($_SESSION['connected'])){
	goPage('/');
}

if(isset($_SESSION['id_user'])){
	$information = get_member($_SESSION['id_user']);
	debug($information);
}

?>

<div class="box">
	<h2 class="profil-title">Profil</h2>
	<p>
	Username :
	<?php
		if(isset($information->username))
			echo "$information->username";
	?>
	<p>
	<p>
	Name : 
	<?php
		if(isset($information->name))
			echo "$information->name";
	?>
	<p>
	<p>
	Email :
	<?php
		if(isset($information->email))
			echo "$information->email";
	?>
	<p>
	<p>
	Description :
	<?php 
		if(isset($information->desc_uti))
			echo "$information->desc_uti";
		else
			echo "pas de description";
	?>
	<p>
</div>
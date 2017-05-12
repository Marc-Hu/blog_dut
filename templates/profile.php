<?php

if(!isset($_SESSION['connected'])){
	goPage('/');
}

if(isset($_SESSION['id_user'])){
	$information = get_member($_SESSION['id_user']);
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
	<p id="nom">
	Name : 
	<?php
		if(isset($information->name))
			echo "$information->name";
	?>
	<div>
	<span style="color: #3D5AFE" class="boutonModif" value="nom">Modifier le Nom</span>
	<div class="modifier">
	<input type="text" placeholder="nom">
	<button id="modifierNom" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	</p>
	<p id="email">
	Email :
	<?php
		if(isset($information->email))
			echo "$information->email";
	?>
	<div>
	<span style="color: #3D5AFE" class="boutonModif" value="email">Modifier l'email</span>
	<div class="modifier">
	<input type="text" placeholder="email">
	<button id="modifierEmail" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	</p>
	<p id="desc">
	Description :
	<?php 
		if(isset($information->desc_uti))
			echo "$information->desc_uti";
		else
			echo "pas de description";
	?>
	<p>
	<div>
	<span style="color: #3D5AFE" class="boutonModif" value="desc">Modifier la description</span>
	<div class="modifier">
	<input type="text" placeholder="desc">
	<button id="modifierDesc" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	</p>
	<div id="mdp">
	<span style="color: #3D5AFE" class="boutonModif" value="email">Modifier le mot de passe</span>
	<div class="modifier">
	<input type="text" placeholder="nouveau mot de passe"><br>
	<input type="text" placeholder="retaper le mot de passe"><br>
	<button id="modifierMdp" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	<?php
		
	?>
</div>
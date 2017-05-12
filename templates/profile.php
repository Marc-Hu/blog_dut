<?php

if(!isset($_SESSION['connected'])){
	goPage('/');
}

if(isset($_SESSION['id_user'])){
	$information = get_member($_SESSION['id_user']);
}

?>


<div class="box" id="profile">
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
	<input type="text" placeholder="nom" class="form-control">
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
	<input type="text" placeholder="email" class="form-control">
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
	<input type="text" placeholder="description" class="form-control">
	<button id="modifierDesc" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	</p>
	<div id="mdp">
	<span style="color: #3D5AFE" class="boutonModif" value="email">Modifier le mot de passe</span>
	<div class="modifier">
	<input type="password" placeholder="nouveau mot de passe" class="form-control"><br>
	<input type="password" placeholder="retaper le mot de passe" class="form-control"><br>
	<button id="modifierMdp" class="btn btn-primary">Soumettre</button>
	</div>
	</div>
	<?php
		
	?>
</div>
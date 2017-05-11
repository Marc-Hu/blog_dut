<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sujets = get_subject($_GET['id']);
	$messages = get_messages($id);
}

/** affichage sujet */
$affichage_suj = ""; // début affichage sujet
if($sujets != false){
	if(isset($sujets->nom)){
		$affichage_suj .= "<h2>$sujets->nom</h2>";
	}
	if(isset($sujets->crea)){
		$crea = new DateTime($sujets->crea);
		$affichage_suj .= "<p class='sujet-crea'>Crée le ".$crea->format('d/m/Y - H:i:s')."</p>";
		if(isset($sujets->crea)){
			$modif = new DateTime($sujets->modif);
			if($modif != $crea){
				$affichage_suj .= "<p class='sujet-modif'>Modifié le ".$modif->format('d/m/Y - H:i:s')."</p>";
			}
		}
	}
	/** affichage messages */
	$affichage_mess = "";
	if($messages != false && $sujets != false){
		foreach ($messages as $message) {
			$affichage_mess .= "<div class='mess box'>";
			if(isset($message->auteur)){
				$auteur = get_member($message->auteur);
				if(isset($auteur)){
					$affichage_mess .= "<p class='author-mess'>$auteur->username</p>";
				}
			}
			if(isset($message->contenu)){
				$affichage_mess .= "<p class='body_mess'>$message->contenu</p>";
			}
			// sous-message
			if(isset($message->id)){
				$sousMessages = get_messages_child($message->id);
				if($sousMessages != false){
					foreach ($sousMessages as $sousMessage) {
						$affichage_mess .= "<div class='sub-mess box'>";
						$auteur = get_member($sousMessage->auteur);
						if(isset($auteur)){
							$affichage_mess .= "<p class='author-mess'>$auteur->username<p>";
						}
						if(isset($sousMessage->contenu)){
							$affichage_mess .= "<p class='body_mess'>$sousMessage->contenu</p>";
						}
						$affichage_mess .= "</div>";
					}
				}
			}
			if(isset($_SESSION['connected'])){
				$affichage_mess .= "<div class='add-message'>
					<div class='form-group'>
						<textarea class='new-message form-control' rows='3'></textarea>
					</div>
					<button class='poster' data-subject=".$_GET['id']." data-parent=".$message->id.">Poster</button>
				</div>";
			}
			$affichage_mess .= "</div>";
		}
		if(isset($_SESSION['connected'])){
			$affichage_mess .= "<div class='add-message'>
				<div class='form-group'>
					<textarea class='new-message form-control' rows='3'></textarea>
				</div>
				<button class='poster' data-subject=".$_GET['id'].">Poster</button>
			</div>";
		}
	}else{
		$affichage_mess .= "<p class='not-found'>Il n'y a pas de message<p>";
		if(isset($_SESSION['connected'])){
			$affichage_mess .= "<div class='add-message'>
				<div class='form-group'>
					<textarea class='new-message form-control' rows='3'></textarea>
				</div>
				<button class='poster' data-subject=".$_GET['id'].">Poster</button>
			</div>";
		}
	}
}else{
	$affichage_suj .= "<p class='not-found'>sujet non trouvé.</p>";
}


?>

<div class="box">
	<div id='sujet'>
		<?php echo $affichage_suj; ?>
	</div>
</div>

<?php
	if(isset($affichage_mess)){
		echo "<div class='box'>";
		echo "<div class='messages'>";
		echo $affichage_mess;
		echo "</div>";
		echo "</div>";
	}
?>


<input type="text" id="user_id" value="<?php if(isset($_SESSION['connected'])) echo $_SESSION['id_user']; ?>" hidden>
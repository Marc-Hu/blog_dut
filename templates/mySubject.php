<?php

// on récupère les sujet avec la position du curseur
$sujets = mySubject($_SESSION['id_user']);


?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
          <h2>Tous les sujets</h2>
          <?php
          	// afficher les sujets
          	if($sujets != false){
	          	foreach ($sujets as $sujet) {
	          		$date = new DateTime($sujet->created_at);
	          		echo "<a href='index.php?page=subject&id=$sujet->id'>
						<p class='sujet'>
						$sujet->name
						<span class='pull-right'>
						".$date->format('d/m/Y - H:i:s')."
						</span>
						</p>
					</a>";
	          	}
          	}else{
          		echo "<p>Il n'y a pas de sujet.</p>";
          	}
          ?>
          
      </div>
    </div>

  </div>
</div>

<?php

if(isset($_GET['idx']))
	$index = $_GET['idx'];
else
	$index = 0;

$nbSubject = nbSujetValid();

$pag = pagination($index, $nbSubject);

// on récupère les sujet avec la position du curseur
$sujets = allSubjects($pag->pos);

// on récupère tous les tags qu'il faut
$tags = allTags();

// gestion du cas ou la pagination vaut 0
if($sujets != false && $pag->pagination == 0)
    $pag->pagination = 1;

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
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
          <nav aria-label="Page navigation">
            <ul class="pagination">
              
              <li><a href="index.php">1</a></li>
              <?php
              	// affichage de la pagination
              	if($pag->pagination > 1){
              		for($i=1; $i<($pag->pagination); $i++){
              			$idx = $i*10;
              			echo "<li><a href='index.php?idx=".$idx."'>".($i+1)."</a></li>";
              		}
              	}
              ?>
            </ul>
          </nav>
      </div>
    </div>
    
    <div class="col-sm-4">
      <div class="box">
        <h2>Les Tags</h2><br>
        <ul class="list-inline">
			<?php
				if($tags != false){
					// affichage recherche par tag
					foreach ($tags as $tag) {
						echo "<li>
						  <a href='index.php?page=bytag&id=$tag->tag_id'>
						    <span class='label label-default Ctag'>$tag->tag_id - $tag->name</span>
						  </a>
						</li><br><br>";
					}
				}
			?>
        </ul>
      </div>
    </div>
  </div>
</div>

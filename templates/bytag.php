<?php

if(isset($_GET["id"])) {
	$sujets = get_subjectByTagId($_GET['id']);
}
?>

<div class="box">
		<?php

			$result = "";
			if (isset($sujets) && $sujets!=false) {
				
				foreach($sujets as $array) {
					$crea = new DateTime($array->crea);
					$result .= "<a href='index.php?page=subject&id=".$array->tag."'><p>".$crea->format('d/m/Y - H:i:s')."</p>";
					if($array->crea != $array->modif) {
						$modif = new DateTime($array->modif);
						$result .= "<p>".$modif->format('d/m/Y - H:i:s')."</p>";	
					}
					$result .= "<p align='center'>$array->nom</p></a>";
				}

			} else {
				$result .= "<p align='center'>Aucun sujet trouvés<p>";
			}
			echo $result;

		?>
</div>
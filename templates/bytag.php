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

<div class="box">
		
</div>
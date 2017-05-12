<?php
session_start();
require_once __DIR__.'/src/functions.php';
require_once __DIR__.'/src/requests.php';

$menu = "";
$connected = true;

if(!isset($_SESSION['connected'])){
	$connected = false;
}else{
	$menu = "
		<li><a href='/index.php?page=profil'>Profile</a></li>
		<li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Action<span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a data-toggle='modal' data-target='#addSubject' id='ajouterSujet'>Ajouter sujet</a></li>
            <li><a href='/index.php?page=msub'>Voir mes sujets</a></li>
          </ul>
        </li>
	";
}

include_once __DIR__.'/templates/header.php';

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = null;
}

switch ($page) {
	case 'signup':
		include_once __DIR__.'/templates/inscription.php';
		break;
	case 'bytag':
		include_once __DIR__.'/templates/bytag.php';
		break;
	case 'signin':
		include_once __DIR__.'/templates/login.php';
		break;
	case 'logout':
		include_once __DIR__.'/templates/logout.php';
		break;
	case 'subject':
		include_once __DIR__.'/templates/subject.php';
		break;
	case 'profil':
		include_once __DIR__.'/templates/profile.php';
		break;
	case 'bytag':
		include_once __DIR__.'/templates/bytag.php';
		break;
	case 'msub':
		include_once __DIR__.'/templates/mySubject.php';
		break;
	default:
		include_once __DIR__.'/templates/home.php';
		break;
}

if(isset($_SESSION['connected']))
	include_once __DIR__.'/templates/modals.php';
include_once __DIR__.'/templates/footer.php';
?>

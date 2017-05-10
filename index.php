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
	default:
		include_once __DIR__.'/templates/home.php';
		break;
}

include_once __DIR__.'/templates/footer.php';
?>

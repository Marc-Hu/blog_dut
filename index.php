<?php

require_once __DIR__.'/src/functions.php';
require_once __DIR__.'/src/requests.php';

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
	case 'signin':
		include_once __DIR__.'/templates/login.php';
		break;
	default:
		include_once __DIR__.'/templates/home.php';
		break;
}

include_once __DIR__.'/templates/footer.php';
?>

<?php

require_once __DIR__.'/../src/functions.php';
require_once __DIR__.'/../src/requests.php';

# on défini si la requête POST retourne bien une action
if(!isset($_POST['action'])){
	$action = "";
}else{
	$action = $_POST['action'];
}

# On defini l'intéraction souhaité
switch ($action) {
	case 'valid_username':
		if(isset($_POST['username'])){
			echo json_encode(["valid"=>is_valid_username($_POST['username'])]);
		}
	break;
	
	case 'signup':
		if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
			
			if(isset($_POST['name'])){
				$name = $_POST['name'];
			}else{
				$name = "";
			}

			if(signup($name, $_POST['username'],  $_POST['email'], $_POST['password'])==true){
				echo json_encode(["valid"=>true]);
			}
		}
	break;
	case 'post_message':
		if(isset($_POST['parent']) && isset($_POST['subject']) && isset($_POST['message'])){
			echo "salut";
		}
	break;
	default:
		include_once __DIR__.'/../templates/header.html';
		include_once __DIR__.'/../templates/footer.html';
		break;
}
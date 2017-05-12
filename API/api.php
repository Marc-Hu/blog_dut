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
		if(isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['author'])){
			if(trim($_POST['message']) != ""){
				if(isset($_POST['parent'])){
					
					$result = set_message($_POST['subject'], $_POST['message'], $_POST['author'], $_POST['parent']);
					echo json_encode(["valid"=>$result]);
				}else{
					$result = set_message($_POST['subject'], $_POST['message'], $_POST['author']);
					echo json_encode(["valid"=>$result]);
				}
			}else{
				echo json_encode(['msg_error'=>"Le message est vide.", "valid"=>false]);
			}
		}
	break;

	case 'add_subject':
		
		if(isset($_POST['nom']) && isset($_POST['tag']) && isset($_POST['id_user'])){
			echo json_encode(["valid"=>add_subject($_POST['nom'],$_POST['id_user'],$_POST['tag'])]);
		}else if(isset($_POST['nom']) && isset($_POST['id_user'])){
			echo json_encode(["valid"=>add_subject($_POST['nom'],$_POST['id_user'])]);
		}
		break;
	
	case 'modifNom':
		if(isset($_POST['userid']) && isset($_POST['nom']))){
			echo json_encode(["valid"=>addNom($_POST['nom'],$_POST['userid'])]);
		}
		break;
	case 'modifEmail':
		if(isset($_POST['userid']) && isset($_POST['email']))){
			echo json_encode(["valid"=>addEmail($_POST['email'],$_POST['userid'])]);
		}
		break;
	case 'modifDesc':
		if(isset($_POST['userid']) && isset($_POST['desc']))){
			echo json_encode(["valid"=>addDesc($_POST['desc'],$_POST['userid'])]);
		}
		break;
	case 'modifMdp':
		if(isset($_POST['userid']) && isset($_POST['mdp']))){
			echo json_encode(["valid"=>addMdp($_POST['mdp'],$_POST['userid'])]);
		}
		break;
	default:
		include_once __DIR__.'/../templates/header.php';
		include_once __DIR__.'/../templates/footer.php';
		break;
}
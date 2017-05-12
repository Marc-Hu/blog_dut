<?php

require_once __DIR__.'/pdo.php';

function nbSujetValid(){
    $request = "SELECT * FROM count_valid_subjects";

    // preparation de la requête
    $pdo = SPDO::getBD();

    $stmt = $pdo->prepare($request);

    if($stmt->execute()){
        return $stmt->fetch(\PDO::FETCH_ASSOC)["count"];
    }else{
        throw new \exceptions(__FUNCTION__.' Erreur SQL : '.$req);
    }
}


function allSubjects($min){
	
    // Requête : afficher tous les sujets 
    $request = "SELECT * FROM get_sujet_by_part(:min)";

    // On prépare la requête
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':min', $min);

    // éxécution
    if($stmt->execute()){
        $nbRow = $stmt->rowCount();
        if($nbRow>0){
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}


function allTags(){
    // Requête : afficher tous les sujets 
    $request = "SELECT * FROM get_tags";

    // On prépare la requête
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);

    // éxécution
    if($stmt->execute()){
        $nbRow = $stmt->rowCount();
        if($nbRow>0)
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        else
            return false;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}


function is_valid_username($username){
    $request = "SELECT * FROM is_valid_username(:username)";

    // On prépare la requête
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':username', $username);

    // éxécution
    if($stmt->execute()){
        $nbRow = $stmt->fetch(\PDO::FETCH_OBJ);
        if($nbRow->nb == 0)
            return true;
        else
            return false;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function signup($name, $username, $email, $password){
    if(trim($name) != ""){
        $request = "SELECT * FROM signup(:username, :name, :email, :password)";
    }else{
        $request = "SELECT * FROM signup_no_name(:username, :email, :password)";
    }

    // On prépare la requête
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    if($name != ""){
        $stmt->bindValue(':name', $name);
    }
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);

    // éxécution
    if($stmt->execute()){   
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}


function signin($username, $password){
    
    $request = "SELECT * FROM verifUtilisateur(:username, :password)";
    

    // On prépare la requête
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);

    // éxécution
    if($stmt->execute()){
        $row = $stmt->fetch(\PDO::FETCH_OBJ);   
        return $row;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_subject($id){
    $request = "SELECT * FROM get_subject_by_id(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id);

    // éxécution
    if($stmt->execute()){
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_subject_user($id){
    $request = "SELECT * FROM get_subject_user(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id);

    // éxécution
    if($stmt->execute()){
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_messages($id_sujet){
    $request = "SELECT * FROM messages_sujet(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id_sujet);

    // éxécution
    if($stmt->execute()){
        $row = $stmt->fetchAll(\PDO::FETCH_OBJ);
        if(sizeof($row) > 0){
            return $row;
        }else{
            return false;
        }
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_messages_child($id){
    $request = "SELECT * FROM messages_fils(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id);

    // éxécution
    if($stmt->execute()){
        $row = $stmt->fetchAll(\PDO::FETCH_OBJ);
        if(sizeof($row) > 0){
            return $row;
        }else{
            return false;
        }
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_member($id){
    $request = "SELECT * FROM get_member_by_id(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id);

    // éxécution
    if($stmt->execute()){
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function get_subjectByTagId($id){
    $request = "SELECT * FROM sujet_tag(:id)";
    $pdo = SPDO::getBD();
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':id', $id);
    if($stmt->execute()){
        $row = $stmt->fetchAll(\PDO::FETCH_OBJ);
        if(sizeof($row) > 0){
            return $row;
        }else{
            return false;
        }
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function set_message($subject, $message, $author, $parent=""){
    
    if(!is_null($parent) && $parent != "NaN" && $parent != ""){
        $request = "SELECT * FROM ajoutMessage(:parent,:auteur,:sujet,:contenu)";
        $pdo = SPDO::getBD();
        $stmt = $pdo->prepare($request);
        $stmt->bindValue(':parent', (int)$parent);
    }else{
        $request = "SELECT * FROM ajoutMessage_no_parent(:auteur,:sujet,:contenu)";
        $pdo = SPDO::getBD();
        $stmt = $pdo->prepare($request);
    }
    
    $stmt->bindValue(':auteur', (int)$author);
    $stmt->bindValue(':sujet', (int)$subject);
    $stmt->bindValue(':contenu', $message);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function add_subject($name, $user_id,$tag=""){
    $pdo = SPDO::getBD();
    if(trim($tag) != ""){
        $request = "SELECT * FROM ajoutPostAvecTag(:name, :tag, :id)";
        $stmt = $pdo->prepare($request);
        $stmt->bindValue(':tag', $tag);
    }else{
        $request = "SELECT * FROM ajoutPostSansTag(:name)";
        $stmt = $pdo->prepare($request);   
    }
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':id', (int)$user_id);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function modifNom($userid, $val){
    $pdo = SPDO::getBD();
    $request = "SELECT * FROM modifName(:id, :val)";
    $stmt = $pdo->prepare($request);
   
    $stmt->bindValue(':val', $val);
    $stmt->bindValue(':id', (int)$userid);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function modifMdp($userid, $val){
    $pdo = SPDO::getBD();
    $request = "SELECT * FROM modifPassword(:id, :val)";
    $stmt = $pdo->prepare($request);
   
    $stmt->bindValue(':val', $val);
    $stmt->bindValue(':id', (int)$userid);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function modifEmail($userid, $val){
    $pdo = SPDO::getBD();
    $request = "SELECT * FROM modifEmail(:id, :val)";
    $stmt = $pdo->prepare($request);
   
    $stmt->bindValue(':val', $val);
    $stmt->bindValue(':id', (int)$userid);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function modifDesc($userid, $val){
    $pdo = SPDO::getBD();
    $request = "SELECT * FROM modifDesc(:id, :val)";
    $stmt = $pdo->prepare($request);
   
    $stmt->bindValue(':val', $val);
    $stmt->bindValue(':id', (int)$userid);
    if($stmt->execute()){
        return true;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}
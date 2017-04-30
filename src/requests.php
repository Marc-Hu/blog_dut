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

/**
 * Retourne tous les sujets du blog. 
 * La requête renvoie que 10 résultats trié par date de création.
 * 
 * TODO : Exception personnaliser pour les requêtes et/ou amélioration de la requête
 * 
 * @param int $min est la position ou commençera la limite
 * @return void si une erreur survient renvoie false, sinon renvoie un tableau associotiatif.
 */
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
        $request = "SELECT * FROM signup(:name, :username, :email, :password)";
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
        return $row->verifutilisateur;
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

function get_message_child($id){

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
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
        $nbRow = $stmt->fetchAll(\PDO::FETCH_OBJ)[0];
        if($nbRow->nb == 0)
            return true;
        else
            return false;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}

function signin($name, $username, $email, $password){
    if(trim($name) != ""){
        $request = "SELECT * FROM signin(:name, :username, :email, :password)";
    }else{
        $request = "SELECT * FROM signin_no_name(:username, :email, :password)";
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
        $nbRow = $stmt->fetchAll(\PDO::FETCH_OBJ)[0];
        return $nbRow->valid;
    }else{
        throw new exception(__FUNCTION__.' Erreur SQL : '.$req);
    }
}
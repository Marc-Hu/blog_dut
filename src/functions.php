<?php

require_once __DIR__.'/pdo.php';

/** 
 * Permt de corriger la pagination
 */
function paginationValidator($pos, $max){
    if($pos < 10){
        return 10;
    } else {
        if(($max-$pos) < 0) return $max;
        else{
            while ($pos%10){
                $pos += 1;
            }
            return $pos;
        }
    }
}

/**
 * Permet de faire la pagination des pages
 */
function pagination($pos, $maxElementPerPag){
        
    while($maxElementPerPag%10 != 0)
        $maxElementPerPag -= 1;
    
    // on determine si la position du curseur est correct
    if($pos%10 != 0 && $pos != 1 || $maxElementPerPag < $pos)
        $pos = paginationValidator($pos, $maxElementPerPag); 
    
    // on détermine le nombre de pagination
    $nb_pagination = round($maxElementPerPag/10);
    
    
    
    $result = (object)[
        'pagination' => $nb_pagination,
        'pos' => $pos
    ];

    return $result;
}

/**
 * Permet de debugger
 */
function debug($value){
    echo "<pre>";
    echo "<div class='alert alert-success'>";
    var_dump($value);
    echo "</div>";
    echo "</pre>";
}


function get_config_db(){
	$conf = file_get_contents(__DIR__.'/../config.json');
	return json_decode($conf)->db;
}

/**
 * Permet de ce rediriger vers un autre page
 */
function goPage($direction){
    header("Location:$direction");
}
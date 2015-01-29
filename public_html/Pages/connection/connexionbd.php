<?php 

function connectBD() {
    $bdd = new PDO("mysql:dbname=pokedex;host=localhost", "M152Pokedex", "projetm152");
    $bdd->exec('set character set utf8');
    return $bdd;
}

?>

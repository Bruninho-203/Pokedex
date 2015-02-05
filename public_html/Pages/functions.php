<?php

function split_separator($str, $separator) {
    $array = array();
    $str_2 = "";
    $i_index = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == $separator) {
            $array[$i_index] = $str_2;
            $str_2 = "";
            $i_index++;
        } else {
            $str_2 .= $str[$i];
        }
    }
    return $array;
}

/*
 * Debug function
 * 
 * Affichage pour debuggage du contenu passé en parametre
 * 
 * @param mixed $sObj element à afficher optionnel
 * @return null
 */

function debug($sObj = NULL) {
    echo '<pre>';
    if (is_null($sObj)) {
        echo '|Object is NULL|' . "\n";
    } elseif (is_array($sObj) || is_object($sObj)) {
        var_dump($sObj);
    } else {
        echo '|' . $sObj . '|' . "\n";
    }
    echo '</pre>';
}

/*
 * @param type $db_name : the name of the database where you want to connect
 * @param type $host : the adress from the host
 * @param type $user : the user who want to connect to the database
 * @param type $pwd : the password
 * @return type : return an connection PDO
 */

function connexion($db_name, $host, $user, $pwd) {
    try {
        $bdd = new PDO('mysql:dbname=' . $db_name . ';host=' . $host, $user, $pwd);
        $bdd->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        $bdd = $e->getMessage();
    }

    return $bdd;
}

function count_nb_user($bdd) {
    $request = $bdd->query("select count(pseudo) from utilisateurs");
    $request = $request->fetchAll();
    return $request[0][0];
}

function login_connection($users, $password, $bdd) {
    $return = false;

    $nb_entite = count_nb_user($bdd);

    $request_pseudo = $bdd->query("select Pseudo from utilisateurs");
    $request_pseudo = $request_pseudo->fetchAll();

    $request_mail = $bdd->query("select Email from utilisateurs");
    $request_mail = $request_mail->fetchAll();

    $request_pwd = $bdd->query("select Mdp from utilisateurs");
    $request_pwd = $request_pwd->fetchAll();

    $request_id = $bdd->query("select idUtilisateur from utilisateurs");
    $request_id = $request_id->fetchAll();


    $request_rang = $bdd->query("SELECT idRang FROM utilisateurs order by idUtilisateur");
    $request_rang = $request_rang->fetchAll();

    for ($i = 0; $i < $nb_entite; $i++) {
        $data_user = $request_pseudo[$i][0];

        $data_mail = $request_mail[$i][0];

        $data_pwd = $request_pwd[$i][0];
        $data_rang = $request_rang[$i][0];

        if (($users == $data_user || $users == $data_mail ) && $password == $data_pwd) {
            $_SESSION['ID'] = $request_id[$i][0];
            $_SESSION['rang'] = $data_rang;
            $return = true;
        }
    }

    return $return;
}

/* * ******           Ajoute personne dans la base                         ******** */

function ajout_personne($Nom, $Prenom, $MotDePasse, $Pseudo, $Email, $bdd) {
    $ajout = $bdd->prepare('insert into utilisateurs(Nom, Prenom,Mdp, Pseudo, idRang, Email) values("' . $Nom . '","' . $Prenom . '","' . $MotDePasse . '","' . $Pseudo . '","1","' . $Email . '")');
    $ajout->execute();
    return $bdd->lastInsertID();
}

/* * ** * * * Message pour l'utilisateur */

function Statut() {

    if (isset($_SESSION["pseudo"]) !== NULL) {
        echo 'Bienvenue ' . $_SESSION['pseudo'];
    }

    if (!isset($_SESSION['pseudo'])) {
        echo 'Bonjour étranger';
    }
}

/* * *************************************************************************** Type ******************************************** */

//Récupération des données de la table type. Ex: 1, Feu, img/feu.png
function recupere_categorie($bdd) {
    $query = "SELECT idType, NomType, cheminImage FROM type";
    $sth = $bdd->query($query);
    $sth->execute();

    return $result = $sth->fetchAll();
}

//Affiche les images des catégories
function affiche_categorie($array) {
    for ($i = count($array) - 1; $i > -1; $i--) {
        echo '<article class="colonnes">'
        . '<a href="Pages/categorie/' . $array[$i]["NomType"] . '.php" data-toggle="tooltip" data-original-title="' . $array[$i]["NomType"] . '">'
        . '<img src="' . $array[$i]["cheminImage"] . '"alt="Icone catégorie"/>'
        . '</a>'
        . '</article>  ';
    }
}

/* * ************************ Pokemon CATEGORIE ******************************************** */

function recupere_categorie_liste($bdd, $idType) {
    $request = $bdd->query('SELECT Nom, cheminImage, pokemon.idPokemon FROM pokemon LEFT JOIN appartenir ON pokemon.idPokemon = appartenir.idPokemon WHERE idType=' . $idType);
    return $request->fetchAll();
}

function affiche_categorie_liste($array) {
//debug($array);

    $i = $ligne = count($array);
//debug($i);
    echo '<article><ul>';

    for ($y = 0; $y < $i; $y++) {
        echo '<li><a href="../../ModifierPokemon.php?id=' . $array[$y][2] . '">' . $array[$y]['Nom'] . ' <img class="ImgagePokemon" src="../../' . $array[$y]["cheminImage"] . '"alt="Pokemon"/></a></li>';
    }
    echo '</ul></article>';
}

function recupere_categorie_aside($bdd, $nomtype) {
    $request = $bdd->query("SELECT NomType, cheminImage FROM type where NomType='" . $nomtype . "' ");
    return $request->fetchAll();
}

//Affiche une image dans un aside pour montrer dans quelle catégorie nous sommes
function affiche_categorie_aside($array, $nomtype) {
    $ligne = count($array);
    for ($i = 0; $i < $ligne; $i++) {
        if ($array[$i]["NomType"] == $nomtype) {
            echo '<img class="ImgagePokemon" src="../../' . $array[$i]["cheminImage"] . '"alt="Catégorie"/>';
        }
    }
}

//*************************  Modification
function recupere_pokemon_modification($bdd, $idPokemon) {
    $request = $bdd->query("SELECT Nom, cheminImage FROM pokemon WHERE idPokemon =" . $idPokemon);
    return $request->fetchAll();
}

function recupere_type_pokemon_modification($bdd, $idPokemon) {
    $request = $bdd->query("SELECT NomType FROM type natural join appartenir WHERE idPokemon =" . $idPokemon);
    return $request->fetchAll();
    echo $request;
}

function donne_idType_avec_nomType($bdd, $nomType) {
    $request = $bdd->query('SELECT idType FROM type WHERE NomType="' . $nomType . '"');
    return $request->fetchAll();
    echo $request;
}

//Affiche les informations du pokemon choisi pour une modification
function affiche_pokemon($arrayPokemon, $idPokemon) {
    $ligne = count($arrayPokemon);
    for ($i = 0; $i < $ligne; $i++) {
        if ($arrayPokemon[$i]["idPokemon"] == $idPokemon) {
            echo '<article>
             <form method="post" action="#">
                 <p>Modifier les informations de votre pokemon</p>
                <p><label>Nom</label> : <input type="text" name="nom_pokemon" placeholder="' . $arrayPokemon[$i]["Nom"] . '" required/></p>
                <p><label>Image</label> : <input type="file" name="image_pokemon"/><img class="ImgagePokemon" src="' . $arrayPokemon[$i]["cheminImage"] . '" alt="Image du pokemon"/></p>

                <p><label for="type">De quel catégorie est le pokemon?</label></p>';
        }
    }
}

//affiche une liste déroulante avec les différents type. De base son type est choisi
function affiche_categorie_option($array, $bdd, $idPokemon) {
    $type = recupere_type_pokemon_modification($bdd, $idPokemon);
    echo '<p><select name="type" id="select_type">';
    $i = count($array);

    while ($i > -1) {
        if ($type[0][0] == $array[$i]["NomType"]) {
            echo '<article><option value="' . $array[$i]["NomType"] . '" selected>' . $array[$i]["NomType"] . '</option>';
            $i--;
        } else {
            echo '<article><option value="' . $array[$i]["NomType"] . '">' . $array[$i]["NomType"] . '</option>';
            $i--;
        }
    }

    echo '</article></select></p>'
    . '<p><label><input class="button grow-rotate" type="submit" name="modifier" value="Confirmer"/></label></p>'
    . '<input type="hidden" name="idPokemonCachee" value=' . $_REQUEST['id'] . '>'
    . '</form></article>';
}

function modifie_pokemon($idPokemon, $nom, $cheminImage, $type, $bdd) {
    $request = 'UPDATE pokemon SET idPokemon="' . $idPokemon . '",Nom="' . $nom . '",cheminImage="' . $cheminImage . '" WHERE idPokemon="' . $idPokemon . '" ';
// Prepare statement
    $statement = $bdd->prepare($request);
// execute the query
    $statement->execute();
// echo a message to say the UPDATE succeeded
    echo $statement->rowCount() . " Information records UPDATED successfully || ";

    $request = 'UPDATE appartenir SET idType="' . $type . '" WHERE idPokemon="' . $idPokemon . '"';
// Prepare statement
    $statement = $bdd->prepare($request);
// execute the query
    $statement->execute();
// echo a message to say the UPDATE succeeded
    echo $statement->rowCount() . " Type records UPDATED successfully ";
}

/* * ******************************** Supprimer */

//Récupere les informations des pokemons dans une liste : (id, nom, Chemin)
function recupere_pokemon($bdd) {
    $request = $bdd->query("SELECT idPokemon, Nom, cheminImage FROM pokemon order by idPokemon");
    return $request->fetchAll();
}

function getPokemonImageName($idPokemon, $bdd) {
    $request = "SELECT cheminImage from pokemon where idPokemon =" . $idPokemon;
    $statement = $bdd->query($request);
    $result = $statement->fetch();
    return $result[0];
}

function supprimerPokemon($idPokemon, $bdd) {
    $request = "DELETE FROM pokemon WHERE idPokemon=" . $idPokemon;

    return $bdd->exec($request);
}

/* * ********** Liste déroulante menu  */

function affiche_categorie_liste_deroulante($array, $TestChemin) {
//debug($array);
    $affichage = "";
    $ligne = count($array);
//debug($i);   
    for ($i = 0; $i < $ligne; $i++) {
        if ($TestChemin == 0) {
            $affichage .= '<li><a href="Pages/categorie/' . $array[$i]["NomType"] . '.php">' . $array[$i]["NomType"] . '</a></li>';
        } elseif ($TestChemin == 1) {
            $affichage .= '<li><a href="./' . $array[$i]["NomType"] . '.php">' . $array[$i]["NomType"] . '</a></li>';
        } else {
            $affichage .= '<li><a href="../categorie/' . $array[$i]["NomType"] . '.php">' . $array[$i]["NomType"] . '</a></li>';
        }
    }
    return $affichage;
}

/* * ********** Créer un pokemon  */

function ajouterPokemon($nom_pokemon, $img_pokemon, $type, $bdd) {


    $request = ('INSERT INTO pokemon(Nom, cheminImage) values("' . $nom_pokemon . '", "' . $img_pokemon . '")');
    $statement = $bdd->prepare($request);
    $statement->execute();

    $id_pokemon = $bdd->lastInsertID();
    echo $id_pokemon;

    $request = ('INSERT INTO appartenir(idPokemon, idType) values ("' . $id_pokemon . '", "' . $type . '")');
    $statement = $bdd->prepare($request);
    $statement->execute();

    return $bdd->lastInsertID();
}

function recupereIDavecNomType($nom_type, $bdd) {
    $request = $bdd->query('SELECT idType FROM type WHERE NomType=' . $nom_type);
    return $request->fetchAll();
    debug($request);
}

function affiche_categorie_option_creer($array) {
    echo '<p><select name="type" id="select_type">';
    $i = count($array);

    while ($i > -1) {
        echo '<article><option value="' . $array[$i][2] . '">' . $array[$i][1] . '</option>';
        $i--;
    }
}

/* * ********** Privilège et droit */

//Contrôle sur l'activation des liens selon le statut de l'utilisateur (Connect/Disconnect)
function affiche_lien($chemin) {
    $affichage = "";
    if ($chemin == 0) {
        if (isset($_SESSION['connected']) && $_SESSION['connected']) {
            $affichage = ' <br/><a href="./Pages/connection/disconnect.php" >Logout</a>';
        } else {
            $affichage = "<a href='./Pages/connection/login.php'>Login</a><br/> <a href='./Pages/connection/inscription.php'>Inscription</a><br/>";
        }
    } elseif ($chemin == 1) {
        if (isset($_SESSION['connected']) && $_SESSION['connected']) {
            $affichage = ' <br/><a href="../connection/disconnect.php" >Logout</a>';
        } else {
            $affichage = "<a href='../connection/login.php'>Login</a><br/> <a href='../connection/inscription.php'>Inscription</a><br/>";
        }
    } else {
        if (isset($_SESSION['connected']) && $_SESSION['connected']) {
            $affichage = ' <br/><a href="./disconnect.php" >Logout</a>';
        } else {
            $affichage = "<a href='login.php'>Login</a><br/> <a href='inscription.php'>Inscription</a><br/>";
        }
    }
    return $affichage;
}

//Ajout d'autorisation pour pouvoir voir les liens et met les chemin à jour selon où l'utilisateur se trouve dans le fils d'Ariane
function autorisation_CRUD_pokemon($rang, $chemin, $bdd) {
    $liens = '';
    if (isset($rang)) {
        if ($rang == 1) {
            if ($chemin == 0) {
                $liens = '<ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="Categorie.php">Catégorie</a>
                                </li>                   
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                            
                                    </ul>
                                </li>   
                            </ul>';
            } elseif ($chemin == 1) {
                $liens = '<ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="../../Categorie.php">Catégorie</a>
                                </li>                   
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                            
                                    </ul>
                                </li>   
                            </ul>';
            } else {
                $liens = '<ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="../../Categorie.php">Catégorie</a>
                                </li>                   
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                            
                                    </ul>
                                </li>   
                            </ul>';
            }
        } elseif ($rang == 2) {

            if ($chemin == 0) {
                $liens = '<ul class="nav navbar-nav">
                        <li class="active">
                            <a href="Categorie.php">Catégorie</a>
                        </li>
                        <li>
                            <a href="supprimerPokemon.php">Supprimer</a>
                        </li>
                        <li>
                            <a href="creerPokemon.php">Creer</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                               
                            </ul>
                        </li>   
                    </ul>';
            } elseif ($chemin == 1) {
                $liens = '<ul class="nav navbar-nav">
                        <li class="active">
                            <a href="../../Categorie.php">Catégorie</a>
                        </li>
                        <li>
                            <a href="../../supprimerPokemon.php">Supprimer</a>
                        </li>
                        <li>
                            <a href="../../creerPokemon.php">Creer</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                               
                            </ul>
                        </li>   
                    </ul>';
            } else {
                $liens = '<ul class="nav navbar-nav">
                        <li class="active">
                            <a href="../../Categorie.php">Catégorie</a>
                        </li>
                        <li>
                            <a href="../../supprimerPokemon.php">Supprimer</a>
                        </li>
                        <li>
                            <a href="../../creerPokemon.php">Creer</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Type <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                ' . affiche_categorie_liste_deroulante(recupere_categorie($bdd), $chemin) . '                                                               
                            </ul>
                        </li>   
                    </ul>';
            }
        }
        return $liens;
    }
}

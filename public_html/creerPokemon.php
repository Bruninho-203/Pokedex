<?php
session_start();

include 'pages/functions.php';
include 'pages/connection/connexionbd.php';

$s_login = "Login";
$s_url = "login.php";
$pseudo = '';
$bdd = connectBD();
$chemin = 0;
$affiche_lien = affiche_lien($chemin);
$cheminCategorie = './Categorie.php';
$cheminSupprime = './supprimerPokemon.php';
$cheminCreer = './creerPokemon.php';

if (isset($_SESSION['conn']) && $_SESSION['conn']) {
    $s_login = "Deconnecter";
    $s_url = "disconnect.php";
    $pseudo = 'Vous êtes le maitre Pokemon: ' . $_SESSION['pseudo'];
}
if (isset($_REQUEST['message'])) {
    echo $_REQUEST['message'];
}

if (isset($_REQUEST["ajoutPokemon"])) {


    $img_pokemon = $_FILES["img_pokemon"];
    $_SESSION["img_pokemon"] = $img_pokemon;

    $nom_pokemon = $_REQUEST["nom_pokemon"];
    $_SESSION["nom_pokemon"] = $nom_pokemon;

    if ($_FILES['img_pokemon']['error'] != 4) {

        $chemin_tmp2 = $_FILES['img_pokemon']['tmp_name'];
        $image = $_FILES['img_pokemon']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $name2 = uniqid($_SESSION['pseudo']);
        $new_chemin2 = "img/pokemon/" . $name2 . '.' . $ext;

        $message = 'Que des images !';


        $extentions_approve = array('image/jpg', 'image/jpeg', 'image/png');

        for ($i = 0; $i < count($_FILES['img_pokemon']['type']); $i++) {
            for ($y = 0; $y < count($extentions_approve); $y++) {
                if ($_FILES['img_pokemon']['type'] == $extentions_approve[$y]) {
                    move_uploaded_file($chemin_tmp2, $new_chemin2);

                    echo $message = 'image uploader';
                } else {
                    echo $message = 'Image invalide';
                }
            }
        }
    }
    $type = $_REQUEST["type"];
    $_SESSION["type"] = $type;
    echo $type;

    $bdd = connectBD();
    ajouterPokemon($nom_pokemon, $new_chemin2, $type, $bdd);
}

if (isset($_REQUEST['envoiRecherche'])) {
    search_pokemon_nom($_REQUEST['recherche'], $bdd);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Pokedex</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Bruno Santos & Jordan Dacuna">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css3/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="img/favicon.png">

        <script type="text/javascript" src="./bootstrap/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body class="container">
        <section class="row clearfix">
            <article class="col-md-12 column">
                <header>  
                    <!-- Fixed navbar -->
                    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="index.php">Pokedex</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <?php
                                if (isset($_SESSION['rang'])) {
                                    echo autorisation_CRUD_pokemon($_SESSION['rang'], $chemin, $bdd);
                                }
                                ?>
                                <form action="#" method="get">
                                    <input type="search" name="recherche"/> 
                                    <input type="submit" name="envoiRecherche" value="Recherche"/>
                                </form>
                                <ul class="nav navbar-nav navbar-right">
                                    <?php echo $affiche_lien; ?> 
                                </ul>
                            </div>                           
                        </div>
                    </nav>
                </header>
                <section class="jumbotron">
                    <h1>
                        Pokedex
                    </h1>
                    <fieldset>
                        <legend>Ajouter un pokemon</legend>
                        <form method="post" action="#" enctype="multipart/form-data">
                            <p><label>Nom</label> : <input type="text" name="nom_pokemon" required/></p>
                            <p><label>Image</label> : <input type="file" name="img_pokemon" accept="image/*"/></p>
                            <p><label for="type">De quel catégorie est le pokemon?</label>

                                <?php
                                affiche_categorie_option_creer(recupere_categorie($bdd), $bdd, -1);
                                echo'</p>';
                                ?>

                                <input class="button grow-rotate" type="submit" name="ajoutPokemon" value="Ajouter Pokemon"/>
                        </form>
                    </fieldset>      
                </section>
            </article>
        </section>
    </body>
</html>

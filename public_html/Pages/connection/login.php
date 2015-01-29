<?php
session_start();
session_destroy();
session_start();

include '../functions.php';
include '../../Pages/connection/connexionbd.php';

$pseudo = '';
$bdd = connectBD();
$chemin = 2;
$affiche_lien = affiche_lien($chemin);


$login = false;

if (isset($_REQUEST["pseudo"]) == true) {
    $users = $_REQUEST["pseudo"];
    $_SESSION["pseudo"] = $users;
} else {
    $users = "";
}
if (isset($_REQUEST["mdp"]) == true) {
    $password = $_REQUEST["mdp"];
    $_SESSION["pwd"] = $password;
} else {
    $password = "";
}

if (isset($_REQUEST["mdp"], $_REQUEST["pseudo"]) == true) {
    $_SESSION["conn"] = true;
    

    $login = login_connection($users, $password, $bdd);
} else {
    $_SESSION["conn"] = false;
}

if ($login) {
    header("Location: ../../index.php");
    $_SESSION["connected"] = TRUE;
    
}
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

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

        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/css/style.css" rel="stylesheet">

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

        <script type="text/javascript" src="../../bootstrap/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
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
                                <a class="navbar-brand" href="../../index.php">Pokedex</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <?php 
                                    if (isset($_SESSION['rang'])) 
                                    {
                                        echo autorisation_CRUD_pokemon($_SESSION['rang'],$chemin, $bdd);
                                    }
                                ?>
                            <ul class="nav navbar-nav navbar-right">
                                <?php echo $affiche_lien; ?> 
                            </ul>
                            </div>                           
                        </div>
                    </nav>
                </header>
                <section class="jumbotron">
                     <fieldset>
                    <legend>Connecte-toi</legend>
                    <form action="#" method="post">
                        <label for="pseudo">Pseudo</label><br />
                        <input type="text" name="pseudo" id="pseudo"/> <br />
                        <label for="mdp">Mot de passe</label><br />
                        <input type="password" name="mdp" id="password"/><br />
                        <input class="button grow-rotate" type="submit" name="connexion" value="Se connecter"/>
                    </form>
                </fieldset>   
                </section>
            </article>
        </section>
    </body>
</html>

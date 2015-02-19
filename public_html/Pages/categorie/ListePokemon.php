<?php 
    session_start();
    
    include '../functions.php';
    include '../connection/connexionbd.php';
    
    $s_login = "Login";
    $s_url = "login.php";
    $pseudo = '';
    $bdd = connectBD();
    $chemin = 1;
    $affiche_lien = affiche_lien($chemin);
    
if (isset($_SESSION['conn']) && $_SESSION['conn']) {
    $s_login = "Deconnecter";
    $s_url = "disconnect.php";
    $pseudo = 'Vous êtes le maitre Pokemon: ' . $_SESSION['pseudo'];
}
    if(isset($_REQUEST['message']))
    {
        echo $_REQUEST['message'];
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Pokedex - <?php echo $NomCategorie;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Bruno Santos & Jordan Dacuna">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css3/style.css" rel="stylesheet">

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
                <div class="top-buffer col-sm-12">
                    <section class="jumbotron col-sm-10">
                        <header>
                            <h1 style="text-align: center"><?php echo $NomCategorie;?></h1>
                        </header>
                        <article>
                            <?php affiche_categorie_Liste(recupere_categorie_liste($bdd, $IdCategorieListe)); ?>
                        </article>
                    </section>

                    <section class="col-sm-2">
                        <aside class="row-md-12">
                            <article>
                                <p>Welcome!</p>
                                <p><?php affiche_categorie_aside(recupere_categorie($bdd), $NomCategorie) ?></p>
                            </article>
                            <fieldset>
                                <p><?php echo $pseudo; ?></p>                     
                            </fieldset>         
                        </aside>   
                    </section>
                </div>
            </article>
        </section>
    </body>
</html>

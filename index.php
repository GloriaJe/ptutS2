<?php
session_start();
$_SESSION['connect'] = 0;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet | Application domotique</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery.js" type="text/javascript"></script>
        <!-- Polices Titres -->
        <link href='https://fonts.googleapis.com/css?family=Nunito:300' rel='stylesheet' type='text/css'>
        <!-- Polices Paragraphes. -->
        <link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <?php include ('connexion_bd.php'); ?>
        <nav>
            <!-- Cette image correspond au logo du site. -->
            <img src="img/lightpi.png" id="logo">
            
            <!-- Menu -->
            <ul class="topnav">
                <!-- Cette image correspond au logo responsive du site. -->
                <img src="img/lightpi.png" id="logo_responsive">
            
                <li><a class="page_courante">Accueil</a></li>
                <li><a href="aide.php">Aide</a></li>
                <li class="icon">
                <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
                </li>
            </ul>
        </nav>
        <div id="espacement"></div>
        
        <!-- Début du contenu -->
            <div id="content">
                
                <?php
                
                /* Si le nom d'utilisateur et le mot de passe ne sont pas renseignés , on affiche le formulaire de login*/
                if (empty($_POST['nom_utilisateur']) && empty($_POST['mdp_utilisateur'])){ 
                    /* Si l'utilisateur a déjà tenté de se connecter : */ 
                    if ((isset($_GET['erreur_login'])) && ($_GET['erreur_login'] == true)){?>
                        <p id="erreur">Login ou mot de passe incorrect</p>
                    <?php } 
                    /* Si l'utilisateur est redirrigé suite au bon fonctionnement d'un changement de mdp */ 
                    if ((isset($_GET['changement_mdp'])) && ($_GET['changement_mdp'] == true)){?>
                        <p>Nouveau mot de passe enregistré</p>
                    <?php }
                    if ((isset($_GET['creation_utilisateur'])) && ($_GET['creation_utilisateur'] == true)){?>
                        <p>Utilisateur créé</p>
                    <?php } ?>

                <form action="index.php" method="post" id="form_connexion">
                    <fieldset>
                        <legend>Authentification</legend>
                            <div class="center">
                                <label for="nom_utilisateur">Nom d'utilisateur</label>
                                <input type="text" name="nom_utilisateur" id="id_utilisateur"><br>


                                <label for="mdp_utilisateur">Mot de passe</label>
                                <input type="password" name="mdp_utilisateur" id="mdp_utilisateur"><br>

                                <input type="submit" value="Connexion">
                            </div>
                    </fieldset>
                </form>
            <?php
                }
                else{ //Traitement du login et du mot de passe
                    

                    $requete = $bdd->query('SELECT * FROM utilisateur');

                    $login_ok = false;

                    while ($donnees = $requete->fetch()){
                        if (($_POST['nom_utilisateur'] == $donnees['nom_utilisateur']) && ($_POST['mdp_utilisateur'] == $donnees['mdp_utilisateur'])){
                            /* Redirection vers l'application domotique */
                            header('Location: app_domotique.php');
                            $login_ok = true;
                            $_SESSION['connect'] = 1;
                        }
                    }
                    if (!($login_ok)){
                    header('Location: index.php?erreur_login=true');
                    }
                    $requete->closeCursor();
                }

            ?>
                <p class="center"><a href="changement_mdp.php" id="lien_changement_mdp">Changer de mot de passe</a></p>
                <p class="center"><a href="creation_utilisateur.php" id="lien_creation_utilisateur">Créer nouvel utilisateur</a></p>
                <p class="center"><a href="suppression_utilisateur.php" id="lien_suppression_utilisateur">Supprimer un utilisateur</a></p>
<!-- On met le <a> dans un <p> pour que le style défini pour le .center s'applique ici. Impossible d'appliquer un text-align : center;  pour un <a> -->
        </div>
            <!-- Fin du contenu -->
        <footer>
                <a href="http://www.iut.unilim.fr/"><img src="img/footer/iut.png" alt="IUT" id="iut"></a>        
                <a href="http://www.unilim.fr/"><img src="img/footer/unilim.png" alt="Unilim" id="unilim"></a>
                <p>© 2016 G3A ALL RIGHTS RESERVED</p>
            </footer>
    </body>
    <script src="javascript/login.js" type="text/javascript"></script>
    <script src="javascript/responsive.js" type="text/javascript"></script>
</html>
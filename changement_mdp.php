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
                
                <li><a href="index.php" class="page_courante">Accueil</a></li>
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
                        <p>Login ou mot de passe incorrect</p>
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
                        }
                    }
                    if (!($login_ok)){
                    header('Location: index.php?erreur_login=true');
                    }
                    $requete->closeCursor();
                }

            ?>
        
            
                
                
            <!-- Changement de mot de passe -->
                
                <form method="post" action="changement_mdp.php" id="form_changement_mdp">
                    <fieldset>
                        <legend>Changement de mot de passe</legend>
                        
                        <?php 
                        if ((isset($_GET['erreur_mdp'])) && ($_GET['erreur_mdp'] == true)){?>
                            <p>Les deux nouveaux mots de passe saisis ne correspondent pas.</p>
                        <?php }
                        if ((isset($_GET['erreur_nom_mdp'])) && ($_GET['erreur_nom_mdp'] == true)){?>
                            <p>Nom ou mot de passe incorrect</p>
                        <?php }
                        ?>
                        
                        <div class="champs">
                            <label for="nom">Nom d'utilisateur</label>
                            <input type="text" name="nom" id="nom" required>
                        </div>
                        <div class="champs">
                            <label for="ancien_mdp">Ancien mot de passe</label>
                            <input type="password" name="ancien_mdp" id="ancien_mdp" required>
                        </div>
                        <div class="champs">
                            <label for="nouveau_mdp">Nouveau mot de passe</label>
                            <input type="password" name="nouveau_mdp" id="nouveau_mdp" required>
                        </div>
                        <div class="champs">
                            <label for="confirmation_mdp">Confirmation nouveau mot de passe</label>
                            <input type="password" name="confirmation_mdp" id="confirmation_mdp" required>
                        </div>
                        <input type="submit" value="Envoyer">
                    </fieldset>
                </form> 
              </div>
        
        
        
        
                <?php
                /* Traitement des données du formulaire de changement de mot de passe */
                if (isset($_POST['nom'])){
                /*Le controle n'est nécéssaire sur un seul des champs car il sont définis "required" */
                    
                    
                    if ($_POST['nouveau_mdp'] != $_POST['confirmation_mdp']){
                        header('Location: changement_mdp.php?erreur_mdp=true');
                    }
                    else{
                        $requete = $bdd->query('SELECT * FROM utilisateur');
                        $changement = false;

                        while ($donnees = $requete->fetch()){

                            if (($donnees['nom_utilisateur'] == $_POST['nom']) && ($donnees['mdp_utilisateur'] == $_POST['ancien_mdp'])){
                            /* Si  l'utilisateur entre le bon login et le bon mot de passe */
                            $id_utilisateur = $donnees['id_utilisateur'];

                            $insertion = $bdd->prepare('UPDATE utilisateur SET mdp_utilisateur=? WHERE id_utilisateur = ?');

                            $insertion->execute(array(
                                $_POST['nouveau_mdp'],
                                $id_utilisateur));
                            
                            $changement = true;
                            header('Location: index.php?changement_mdp=true');
                            }
                        }
                        
                        if(!($changement)){
                            header('Location: changement_mdp.php?erreur_nom_mdp=true');
                        }
                    } 
                }        
                ?>
        
        
        
        
        
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
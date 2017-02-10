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


                                <label for="mdp_utilisateur">Mot de passe
                                </label>
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
                    header('Location: login.php?erreur_login=true');
                    }
                    $requete->closeCursor();
                }

            ?>
        
            
                
                
            <!-- Création d'un nouvel utilisateur -->
                
                <form method="post" action="creation_utilisateur.php" id="form_creation_utilisateur">
                    <fieldset>
                        <legend>Création d'un utilisateur</legend>
                        
                        <?php 
                        if ((isset($_GET['erreur_mdp'])) && ($_GET['erreur_mdp'] == true)){?>
                            <p>Les deux mots de passes ne correspondent pas.</p>
                        <?php }
                        if ((isset($_GET['erreur_authentification'])) && ($_GET['erreur_authentification'] == true)){?>
                            <p>Mauvais mot de passe pour root</p>
                        <?php }
                        if ((isset($_GET['utilisateur_existant'])) && ($_GET['utilisateur_existant'] == true)){?>
                            <p>L'utilisateur existe déjà.</p>
                        <?php }
                        ?>
                        
                        <div class="champs">
                            <label for="nom">Nom de l'utlisateur</label>
                            <input type="text" name="nom" id="nom" required>
                        </div>
                        <div class="champs">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" name="mdp" id="mdp" required>
                        </div>
                        <div class="champs">
                            <label for="confirmation_mdp">Confirmation mot de passe</label>
                            <input type="password" name="confirmation_mdp" id="confirmation_mdp" required>
                        </div>
                        <div class="champs">
                            <label for="mdp_root">Mot de passe administrateur</label>
                            <input type="password" name="mdp_root" id="mdp_root" required>
                        </div>
                        <input type="submit" value="Envoyer">
                    </fieldset>
                </form> 
              </div>
        
        
        
        
                <?php
                /* Traitement des données du formulaire de creation d'utilisateur*/
                if (isset($_POST['nom'])){
                /*Le controle n'est nécéssaire sur un seul des champs car il sont définis "required" */
                    
                    
                    if ($_POST['mdp'] != $_POST['confirmation_mdp']){
                        header('Location: creation_utilisateur.php?erreur_mdp=true');
                    }
                    else{
                        $utilisateur_existant = false;
                        $requete = $bdd->query('SELECT * FROM utilisateur');
                        while ($donnees = $requete->fetch()){
                            if ($_POST['nom'] == $donnees['nom_utilisateur']){
                                $utilisateur_existant = true;
                            }
                        }
                        $requete->closeCursor();
                        if ($utilisateur_existant){
                            header('Location: creation_utilisateur.php?utilisateur_existant=true');
                        }
                        else{
                        
                            
                            $requete = $bdd->query('SELECT * FROM utilisateur WHERE nom_utilisateur = \'root\' ');
                            $changement = false;

                            while ($donnees = $requete->fetch()){

                                if (($donnees['mdp_utilisateur'] == $_POST['mdp_root'])){
                                /* Si  l'utilisateur entre le bon password pour root */


                                    $insertion = $bdd->prepare('INSERT INTO utilisateur(nom_utilisateur, mdp_utilisateur) VALUES (? ,?) ');

                                    $insertion->execute(array(
                                        $_POST['nom'],
                                        $_POST['mdp']));

                                    $changement = true;
                                    header('Location: index.php?creation_utilisateur=true');
                                }
                            }

                            if(!($changement)){
                                header('Location: creation_utilisateur.php?erreur_authentification=true');
                            }
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
<!DOCTYPE html>
<html>
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
                <h1 class="center" id="users">Utilisateurs enregistrés</h1>
      
                <?php
                    if ((isset($_GET['erreur_mdp'])) && ($_GET['erreur_mdp'] == true)){
                        echo 'Mot de passe administrateur incorrect';
                    }
                
                ?>
                <?php
                $requete = $bdd->query('SELECT * FROM utilisateur WHERE nom_utilisateur != \'root\'');
                while ($donnees = $requete->fetch()){
                    ?><fieldset><?php
                    echo '<p class="center"> ' . $donnees['nom_utilisateur'] . '</p>';
                    ?>
                    <form method="post" action="suppression_utilisateur.php">
                
                        <input type="hidden" name="id_a_supprimer" value="<?php echo $donnees['id_utilisateur']?>">
                        
                        <label for="pass_root">Mot de passe administrateur</label>
                        <input type="password" name="pass_root" id="pass_root" required>
                        <input type="submit" value="Supprimer">
                
                </form></fieldset>
                    <?php
                }

                ?>
                
                
                <!-- Traitement de la suppression -->
                <?php
                if(isset($_POST['pass_root'])){
                    
                    $requete=$bdd->query('SELECT * FROM utilisateur WHERE nom_utilisateur = \'root\'');
                    $donnees = $requete->fetch();
                    if ($_POST['pass_root'] == $donnees['mdp_utilisateur']){
                        $suppression = $bdd->prepare('DELETE FROM utilisateur WHERE id_utilisateur = ?');
                        $suppression->execute(array(
                                            $_POST['id_a_supprimer']));
                        header('Location: suppression_utilisateur.php');
                    }
                    else{
                        header('Location: suppression_utilisateur.php?erreur_mdp=true');
                    }
                
                }
                ?>    
            </div>        
        
        <!-- Fin du contenu -->
        <footer>
                <a href="http://www.iut.unilim.fr/"><img src="img/footer/iut.png" alt="IUT" id="iut"></a>        
                <a href="http://www.unilim.fr/"><img src="img/footer/unilim.png" alt="Unilim" id="unilim"></a>
                <p>© 2016 G3A ALL RIGHTS RESERVED</p>
        </footer>
        <script src="javascript/responsive.js" type="text/javascript"></script>
    </body>
</html>
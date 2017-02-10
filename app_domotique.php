<?php
session_start();
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
        
        <!-- Si l'utilisateur est connecté -->
        <?php
            if ($_SESSION['connect'] == 1){
        ?>
        <!-- Début du contenu -->
        
        <div id="content">
            <article>
                <h1 class="center">Application domotique</h1>
                <p class="center">Veuillez cliquer sur les lampe afin d'activer l'allumage des LEDs.</p>
                <div id="div_maquette">

                    <img id="img_sejour" name="18" class = "picto_lampe" src="img/pictos/lampe_eteinte.png" alt="lampe_sejour">

                    <img id="img_cuisine" name ="22" class = "picto_lampe"  src="img/pictos/lampe_eteinte.png" alt="lampe_cuisine">

                    <img id="img_chambre" name="23" class = "picto_lampe"  src="img/pictos/lampe_eteinte.png" alt="lampe_chambre">

                    <img id="img_sdb" name="17" class = "picto_lampe"  src="img/pictos/lampe_eteinte.png" alt="lampe_eteinte">
                </div>
                <h1 class="center">Choisissez vos propres paramètres</h1>
                <div id="boutons_reglage">
                    <p >Allumage de l'intégralité des lampes</p>
                    <input id="boutonGlobal" type="button" value="Allumer">
                    <p >Clignotement de l'intégralité des lampes</p>
                    <input id="boutonClignoterGlob" type="button" value="Clignoter">
                </div>

                <div id="div_tableau"> 
                    <table>
                        <tr>
                            <th>Pièce</th>
                            <th>Etat</th>
                            <th>Intensité</th>
                            <th>Clignotement</th>
                        </tr>
                        <tr>
                            <td><strong>Séjour</strong></td>
                            <td><img id="tab_sejour" class="picto_lampe" src="img/pictos/lampe_eteinte.png"</td>
                            <td><img id="moins_sejour" class="picto_moins" src="img/pictos/minus.png" alt="minus"><img id="plus_sejour" class="picto_plus" src="img/pictos/plus.png" alt="plus"><progress id="progress_sejour" class ="progress" value="0" max ="100"></progress></td>
                            <td><form><label>Intervalle : </label><input id="vitesse_sejour" type="number" value="0.5" min="0.1" step="0.1" max="60"><label>sec</label><input id="clignoterSejour" type="button" value="Clignoter"></form></td>
                        </tr>
                        <tr>
                            <td><strong>Cuisine</strong></td>
                            <td><img id="tab_cuisine" class="picto_lampe" src="img/pictos/lampe_eteinte.png"</td>
                            <td><img id="moins_cuisine" class="picto_moins" src="img/pictos/minus.png" alt="minus"><img id="plus_cuisine" class="picto_plus" src="img/pictos/plus.png" alt="plus"><progress id="progress_cuisine" class ="progress" value="0" max ="100"></progress></td>
                            <td><form><label>Intervalle :</label> <input id="vitesse_cuisine" type="number" value="0.5" min="0.1" step="0.1" max="60"><label>sec </label><input id="clignoterCuisine" type="button" value="Clignoter"></form></td>
                        </tr>
                        <tr>
                            <td><strong>Chambre</strong></td>
                            <td><img id="tab_chambre" class="picto_lampe" src="img/pictos/lampe_eteinte.png"</td>
                            <td><img id="moins_chambre" class="picto_moins" src="img/pictos/minus.png" alt="minus"><img id="plus_chambre" class="picto_plus" src="img/pictos/plus.png" alt="plus"><progress id="progress_chambre" class ="progress" value="0" max ="100"></progress></td>
                            <td><form><label>Intervalle :</label><input id="vitesse_chambre" type="number" value="0.5" min="0.1" step="0.1" max="60"><label> sec</label><input id="clignoterChambre" type="button" value="Clignoter"></form></td>
                        </tr>
                        <tr>
                            <td><strong>Sdb</strong></td>
                            <td><img id="tab_sdb" class="picto_lampe" src="img/pictos/lampe_eteinte.png"</td>
                            <td><img id="moins_sdb" class="picto_moins" src="img/pictos/minus.png" alt="minus"><img id="plus_sdb" class="picto_plus" src="img/pictos/plus.png" alt="plus"><progress id="progress_sdb" class ="progress" value="0" max ="100"></progress></td>
                            <td><form><label>Intervalle :</label><input id="vitesse_sdb" type="number" value="0.5" min="0.1" step="0.1" max="60"><label> sec</label> <input id="clignoterSdb" type="button" value="Clignoter"></form></td>
                        </tr>
                    </table>
                </div>
                
                <h1 class="center">Programmation de l'allumage</h1>
                
                
                <form>
                    <fieldset id="formProg">
                        <legend>Gérez l'allumage de vos lampes !</legend>
                        <input type="radio" name="salle" value="sejour" class="choix"><label >Salon</label><br>
                        <input class="choix" type="radio" name="salle" value="cuisine"><label>Cuisine</label><br>
                        <input class="choix" type="radio" name="salle" value="chambre"><label>Chambre</label><br>
                        <input class="choix" type="radio" name="salle" value="sdb"><label>Salle de bain</label><br>
                        <input class="choix" type="radio" name="salle" value="toutes"><label>Toutes les pieces</label><br>
                        <br>
                        <label>Dans</label> <input type="number" min="0" step="1" max="48" id="heures" value="0"><label>h,</label>  <input type="number" min="0" step="1" max="59" id="minutes" value="0"> <label>min,</label> <input type="number" min="0" step="1" max="59" id="secondes" value="0"><label>sec.</label> 
            
                        <input type="button" id="boutonTimer" value="Envoyer">
                    </fieldset>
                </form>
                
                <p id="dateEntree"></p>
                
                
            </article>
        </div>
        
        <?php
            }else{
                header('Location: index.php');
            }?>
            <!-- Fin du contenu -->
        <footer>
            <a href="http://www.iut.unilim.fr/"><img src="img/footer/iut.png" alt="IUT" id="iut"></a>        
            <a href="http://www.unilim.fr/"><img src="img/footer/unilim.png" alt="Unilim" id="unilim"></a>
            <p>© 2016 G3A ALL RIGHTS RESERVED</p>
        </footer>
        
        <!-- JS.-->
        <script src="javascript/script.js" type="text/javascript"></script>
        <script src="javascript/responsive.js" type="text/javascript"></script>
        
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet | Aide</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- Polices Titres -->
        <link href='https://fonts.googleapis.com/css?family=Nunito:300' rel='stylesheet' type='text/css'>
        <!-- Polices Paragraphes. -->
        <link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css'>
    </head>

    
    <body>
        <header>
            <nav>
                
                <!-- Cette image correspond au logo du site. -->
                <img src="img/lightpi.png" id="logo">
                
                <!-- Menu -->
                <ul class="topnav">
                    <!-- Cette image correspond au logo responsive du site. -->
                    <img src="img/lightpi.png" id="logo_responsive">
                    
                    <li><a href="index.php">Accueil</a></li>
                    <li><a class="page_courante">Aide</a></li>
                    <li class="icon">
                    <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
                    </li>
                </ul>
            </nav>
            <div id="espacement"></div>
        </header>
        
        <!-- Début du contenu -->
        
        <div id="content">
            <article id="push_aide">
                <h1>Aide</h1>
                <p>Si vous rencontrez des problèmes techniques avec le montages ? Nous vous invitons à utiliser le documents ci dessous :</p>
                <p>Pour télécharger la notice technique, <a href="docs/notice.pdf" download="Notice_Technique">cliquez ici</a></p>
            </article>
        </div>
        
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
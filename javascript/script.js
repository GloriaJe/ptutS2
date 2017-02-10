/* SWITCH */

function switchLampe(piece) {

    var img = document.getElementById("img_" + piece);
    var num = img.getAttribute("name");
    var src = img.getAttribute("src");

    
    /* On change sur la maquette */
    if (src == "img/pictos/lampe_eteinte.png"){
	$.ajax({
		url: "cgi-bin/test.cgi?numero="+num+"&intensite="+1
  	});
        img.setAttribute("src", "img/pictos/lampe_allume.png");
    }
    else{
	$.ajax({
		url: "cgi-bin/test.cgi?numero="+num+"&intensite="+0
  	});
        img.setAttribute("src", "img/pictos/lampe_eteinte.png");
    }
    
    /* On change sur le tableau */
    
    var img = document.getElementById("tab_"+piece);
    var src = img.getAttribute("src");
    
    if (src == "img/pictos/lampe_eteinte.png"){
        img.setAttribute("src", "img/pictos/lampe_allume.png");
       
        /* On définit l'intensité max dans le tableau */
        var progress = document.getElementById("progress_"+piece);
        progress.setAttribute("value", 100);
    }
    else{
        img.setAttribute("src", "img/pictos/lampe_eteinte.png");
        
        /* On définit l'intensité min dans le tableau */
        var progress = document.getElementById("progress_"+piece);
        progress.setAttribute("value", 0);
    }
}

/* SEJOUR */
document.getElementById("img_sejour").onclick=function(){
    switchLampe("sejour"); 
}

document.getElementById("tab_sejour").onclick=function(){
    switchLampe("sejour");
}

/* CHAMBRE */
document.getElementById("img_chambre").onclick=function(){
    switchLampe("chambre"); 
}
document.getElementById("tab_chambre").onclick=function(){
    switchLampe("chambre");
}

/* CUISINE */
document.getElementById("img_cuisine").onclick=function(){
    switchLampe("cuisine"); 
}
document.getElementById("tab_cuisine").onclick=function(){
    switchLampe("cuisine");
}


/* SDB */
document.getElementById("img_sdb").onclick=function(){
    switchLampe("sdb"); 
}
document.getElementById("tab_sdb").onclick=function(){
    switchLampe("sdb");
}


/* VARIATION INTENSITE */

function plusIntensite(piece){
    var progress = document.getElementById("progress_"+piece);
    var value = progress.getAttribute("value");
    var img = document.getElementById("img_"+piece);
    var num = img.getAttribute("name");

  
    
    if(value < 100){
        /* AJAX */
        progress.value += 10;
	$.ajax({
		url: "cgi-bin/test.cgi?numero="+num+"&intensite="+progress.value/100
  	});
        img.setAttribute("src", "img/pictos/lampe_allume.png");
        document.getElementById("tab_"+piece).setAttribute("src", "img/pictos/lampe_allume.png"); 
    }
    else{
        alert("Impossible d'augmenter encore l'intensité");
    }
}


function moinsIntensite(piece){
    var progress = document.getElementById("progress_"+piece);
    var value = progress.getAttribute("value");
    var img = document.getElementById("img_"+piece);
    var num = img.getAttribute("name");
    
    if(value > 0){
        /* AJAX */
        progress.value -= 10;
	$.ajax({
		url: "cgi-bin/test.cgi?numero="+num+"&intensite="+progress.value/100
  	});
        if (value == 10){ //On change la lampe si le clic met l'intensité à 0
            document.getElementById("img_"+piece).setAttribute("src", "img/pictos/lampe_eteinte.png");
            document.getElementById("tab_"+piece).setAttribute("src", "img/pictos/lampe_eteinte.png");
        }
    }
    else{
        alert("Impossible de diminuer encore l'intensité");
    }
}

/* SEJOUR */

document.getElementById("plus_sejour").onclick=function(){
    plusIntensite("sejour");
}

document.getElementById("moins_sejour").onclick=function(){
    moinsIntensite("sejour");
}

/* CUISINE */

document.getElementById("plus_cuisine").onclick=function(){
    plusIntensite("cuisine");
}

document.getElementById("moins_cuisine").onclick=function(){
    moinsIntensite("cuisine");
}

/* CHAMBRE */

document.getElementById("plus_chambre").onclick=function(){
    plusIntensite("chambre");
}

document.getElementById("moins_chambre").onclick=function(){
    moinsIntensite("chambre");
}

/* SDB */

document.getElementById("plus_sdb").onclick=function(){
    plusIntensite("sdb");
}

document.getElementById("moins_sdb").onclick=function(){
    moinsIntensite("sdb");
}


/* CLIGNOTEMENT */









var clignoSejour = false;
var clignoCuisine = false;
var clignoChambre = false;
var clignoSdb = false;

function clignoter(piece){
  switch (piece){
      case "sejour" :
            if (!(clignoSejour)){
                clignoSejour = true;
                intervalSejour = setInterval(function(){switchLampe("sejour")}, vitesse_sejour);
            }
            else{
                clignoSejour = false;
                clearInterval(intervalSejour);

                var img = document.getElementById("img_sejour");
                var src = img.getAttribute("src");
                if (src == "img/pictos/lampe_allume.png"){
                    switchLampe("sejour");
                }
            }
        break;
      case "cuisine" :
            if (!(clignoCuisine)){
                clignoCuisine = true;
                intervalCuisine = setInterval(function(){switchLampe("cuisine")}, vitesse_cuisine);
            }
            else{
                clignoCuisine = false;
                clearInterval(intervalCuisine);
                var img = document.getElementById("img_cuisine");
                var src = img.getAttribute("src");
                if (src == "img/pictos/lampe_allume.png"){
                    switchLampe("cuisine");
                }
            }
          break;
      case "chambre" :
            if (!(clignoChambre)){
                clignoChambre = true;
                intervalChambre = setInterval(function(){switchLampe("chambre")}, vitesse_chambre);
            }
            else{
                clignoChambre = false;
                clearInterval(intervalChambre);
                var img = document.getElementById("img_chambre");
                var src = img.getAttribute("src");
                if (src == "img/pictos/lampe_allume.png"){
                    switchLampe("chambre");
                }
            }
          break;
      case "sdb" :
            if (!(clignoSdb)){
                clignoSdb = true;
                intervalSdb = setInterval(function(){switchLampe("sdb")}, vitesse_sdb);
            }
            else{
                clignoSdb = false;
                clearInterval(intervalSdb);
                var img = document.getElementById("img_sdb");
                var src = img.getAttribute("src");
                if (src == "img/pictos/lampe_allume.png"){
                    switchLampe("sdb");
                }
            }
          break;
  }
}
 
document.getElementById("clignoterSejour").onclick=function(){
    var champs_sejour = document.getElementById("vitesse_sejour");
    vitesse_sejour = champs_sejour.value*1000;
    clignoter("sejour");
}

document.getElementById("clignoterCuisine").onclick=function(){
    var champs_cuisine = document.getElementById("vitesse_cuisine");
    vitesse_cuisine = champs_cuisine.value*1000;
    clignoter("cuisine");
}

document.getElementById("clignoterChambre").onclick=function(){
    var champs_chambre = document.getElementById("vitesse_chambre");
    vitesse_chambre = champs_chambre.value*1000;
    clignoter("chambre");
}

document.getElementById("clignoterSdb").onclick=function(){
    var champs_sdb = document.getElementById("vitesse_sdb");
    vitesse_sdb = champs_sdb.value*1000;
    clignoter("sdb");
}

/* Allumage de toutes les lampes via le bouton */ 

document.getElementById("boutonGlobal").onclick=function(){
    var img=document.getElementById("boutonGlobal")

    var value = img.getAttribute("value");
    
    if (value == "Allumer"){
        img.setAttribute("value", "Eteindre");
        allumerTout();

    }
    else{ 
        img.setAttribute("value", "Allumer");
        eteindreTout();
    }
    
}

function allumerTout(){
        var img = document.getElementById("img_sejour");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_eteinte.png"){
            switchLampe("sejour");
        }
        
        img = document.getElementById("img_cuisine");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_eteinte.png"){
            switchLampe("cuisine");
        }
    
        img = document.getElementById("img_chambre");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_eteinte.png"){
            switchLampe("chambre");
        }
    
        img = document.getElementById("img_sdb");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_eteinte.png"){
            switchLampe("sdb");
        }
}

function eteindreTout(){
        var img = document.getElementById("img_sejour");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_allume.png"){
            switchLampe("sejour");
        }
        
        img = document.getElementById("img_cuisine");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_allume.png"){
            switchLampe("cuisine");
        }
    
        img = document.getElementById("img_chambre");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_allume.png"){
            switchLampe("chambre");
        }
    
        img = document.getElementById("img_sdb");
        src = img.getAttribute("src");

        if (src == "img/pictos/lampe_allume.png"){
            switchLampe("sdb");
        }
}

document.getElementById("boutonClignoterGlob").onclick=function(){
    var img=document.getElementById("boutonClignoterGlob")

    var champs_sejour = document.getElementById("vitesse_sejour");
    vitesse_sejour = champs_sejour.value*1000;
    var champs_cuisine = document.getElementById("vitesse_cuisine");
    vitesse_cuisine = champs_cuisine.value*1000;
    var champs_chambre = document.getElementById("vitesse_chambre");
    vitesse_chambre = champs_chambre.value*1000;
    var champs_sdb = document.getElementById("vitesse_sdb");
    vitesse_sdb = champs_sdb.value*1000;
    
    var value = img.getAttribute("value");
    
    if (value == "Clignoter"){
        img.setAttribute("value", "Eteindre");
        clignoter("cuisine");
        clignoter("chambre");
        clignoter("sdb");
        clignoter("sejour");
        /* AJAX POUR FAIRE CLIGNOTER TOUT EN MEME TEMPS */
    }
    else{
        img.setAttribute("value", "Clignoter");
        clignoter("cuisine");
        clignoter("chambre");
        clignoter("sdb");
        clignoter("sejour");
        /* AJAX POUR FAIRE CLIGNOTER TOUT EN MEME TEMPS */
    }
}
/* MATASSE */

var interval;
var heuresRestante;
var minutesRestante;
var secondesRestante;
var salle;

function tempsRestant(){
    
    if(Number(heuresRestante) >= 0 && Number(minutesRestante) >= 0 && Number(secondesRestante) > 0){
        
        secondesRestante = Number(secondesRestante-1);
        
    }
    
    if(Number(heuresRestante) >= 0 && Number(minutesRestante) > 0 && Number(secondesRestante) == 0){
        
        minutesRestante = Number(minutesRestante-1);
        secondesRestante = 59;
        
    }
    
    if(Number(heuresRestante) > 0 && Number(minutesRestante) == 0 && Number(minutesRestante) == 0){
        heuresRestante = Number(heuresRestante-1);
        minutesRestante = 59;
        secondesRestante = 59;
    }
    
    if(Number(heuresRestante) >= 0 && Number(minutesRestante) == 0 &&  Number(secondesRestante) == 0){
        
        if (salle == "toutes"){
            allumerTout();
        }
        else{
            switchLampe(salle);
        }
        clearInterval(interval);
        
    }
    dateEntree.innerHTML = "<p>Allumage dans "+ heuresRestante +" heure(s) " + minutesRestante + " minute(s) " + secondesRestante + " seconde(s) </p>";  
    
}
    

function detecterTimer() {
    
    var bouton = document.getElementById('boutonTimer');
    
    bouton.addEventListener("click",function(){
        
        clearInterval(interval);
        var now = new Date();
        
        var dateEntree = document.getElementById("dateEntree");
        var heure = document.getElementById("heures");
        var minute = document.getElementById("minutes");
        var seconde = document.getElementById("secondes");
        salle = $('input[name=salle]:checked').val();

        
            
        if( (Number(heure.value) <48 && Number(heure.value)>= 0) && (Number(minute.value) < 60 && Number(minute.value) >= 0) && (Number(seconde.value) < 60 && Number(seconde.value) >= 0)){
            
            dateEntree.innerHTML = "<p>Allumage dans "+ heure.value +" heure(s) " + minute.value + " minute(s) " + seconde.value + " seconde(s) </p>";  
            
            heuresRestante=Number(heure.value);
            minutesRestante=Number(minute.value);
            secondesRestante=Number(seconde.value);
            
            interval = setInterval('tempsRestant()', 1000);
        
        }else{
            
            dateEntree.innerHTML = "<p>Erreur dans le temps entré</p>"; 
            
        }
        
    });
    
}

window.onload=function (){    
    detecterTimer();
}
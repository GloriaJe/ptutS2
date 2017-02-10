/* Fonction qui permet d'afficher le formulaire de changement de mot de passe au clic sur le lien */

$('#bouton_changement_mdp').click(function(){
    var formulaire = document.getElementById('form_changement_mdp');
    formulaire.style.display = 'block';
});


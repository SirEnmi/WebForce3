// recherche.js

// page chargée ?
$(document).ready(function(){
	//alert('ok');

	//bouton du formulaire cliqué ?
	$('#btnSearch').on('click', function(){
		//alert('btn'); //vérification

		//si champs de recherche vide
		if($('#rechercheArticle').val() == ''){
			alert('La recherche ne peut etre vide...');
			return false; //on ne soumet pas le formulaire
		} //fin if
	}); //fin bouton
}); //fin document.ready
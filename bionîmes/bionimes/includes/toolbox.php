<?php
	
	/* Vérification de la complexité du mot de passe:
		- 8 caracteres minimu
		- au moins une majuscule
		- au moins un chiffre
	*/
	function verifPassword($mdp){
		//longueur du mot de passe
		$longueur = strlen($mdp);
		//compteurs Majuscules et Chiffres
		$nbMaj = $nbInt = 0;
		//boucle de lecture
		for($i= 0; $i < $longueur; $i++){
			//numérique ?
			if(is_numeric($mdp[$i])) $nbInt++;
			//majuscule ?
			else if(strtoupper($mdp[$i]) === $mdp[$i]) $nbMaj++;
		}
		//controles et retour
		if($longueur >= 8 AND $nbMaj >= 1 AND $nbInt >=1) return true;
		else return false;
	}
?>
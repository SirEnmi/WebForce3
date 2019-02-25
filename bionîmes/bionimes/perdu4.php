<?php
	/* perdu4.php */
	$titrePage = 'Bio Nîmes - Modification du mot de passe';
	include 'includes/header.php';
	include 'includes/navbar.php';
	include 'includes/toolbox.php';

	//mr propre
	$safe = array_map('strip_tags', $_POST);
	//mots de passe indentiques
	if($safe['password'] !== $safe['password2']){
		echo 	'<div class="alert alert-danger">
					 Les mots de passe doivent être identiques.
					 <a href="#" onclick="window.history.go(-1); return false;">
					 	Recommencer
					 </a>
				 </div>';
	}
	else{
		//complexite mot de passe
		if(verifPassword($safe['password'])){
			$hash = password_hash($safe['password'], PASSWORD_DEFAULT);
			//mise à jour ficher client
			$rqMajclient= "UPDATE clients SET password = :password, token = null WHERE idClient = :idClient";
			//preparation
			$stmtMajclient = $dbh->prepare($rqMajclient);
			//parametres
			$params = array(':password' => $hash, ':idClient' => $safe['idClient']);
			//execution
			if($stmtMajclient->execute($params)){
				echo '<div class="alert alert-success">Votre mot de passe a été modifié</div>';
			}
			else echo '<div class="alert alert-danger">Erreur</div>';
		}
		else {
			echo 	'<div class="alert alert-danger">
						 Votre mot de passe doit comporter au moins 8 caractères dont 1 majuscule et 1 chiffre
						 <a href="#" onclick="window.history.go(-1); return false;">
					 		 Recommencer
					 	 </a>
					 </div>';
		}
	}
	include 'includes/footer.php'
?>
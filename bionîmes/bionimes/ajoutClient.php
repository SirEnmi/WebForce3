<?php
	include 'includes/connexion.php';
	include 'includes/toolbox.php';

	//Mr Propre
	$safe = array_map('strip_tags', $_POST);
	//verif mdp
	if(verifPassword($safe['password'])){
		//requête
		$rqAjout = "INSERT INTO clients(nom, prenom, email, password, tel, adresse, cp, ville, consentement, role) VALUES (:nom, :prenom, :email, :password, :telephone, :adresse, :codePostal, :ville, :consentement, :role)";
		//preparation
		$stmtAjoutClient = $dbh->prepare($rqAjout);
		//encodage MDP
		$password = password_hash($safe['password'], PASSWORD_DEFAULT);
		//consentement
		if (isset($safe['consentement'])){
			$consentement = 1;
		}
		else $consentement = 0;
		$params = array(':nom' => $safe['nom'], ':prenom' => $safe['prenom'], ':email' => $safe['email'], ':password' => $password, ':telephone' => $safe['tel'], ':adresse' => $safe['adresse'], ':codePostal' => $safe['cp'], ':ville' => $safe['ville'], ':consentement' => $consentement, ':role' => 0);
		//execution
		if($stmtAjoutClient->execute($params)){
			$message = "Merci pour votre inscription";
		}
		else $message = "Erreur";
	}
	else $message = "Mot de passe non conforme";

	echo 	'<script>
				alert("'.$message.'");
				window.location.href="inscription.php";
			</script>';
?>
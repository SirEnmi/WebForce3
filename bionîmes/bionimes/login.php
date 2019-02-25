<?php
	/* login.php */
	session_start();

	//mr propre
	$safe = array_map('strip_tags', $_POST);
	//boite à outils pour le mot de passe
	include 'includes/toolbox.php';
	if(verifPassword($safe['password'])){
		//connexion BDD
		include 'includes/connexion.php';
		//requete
		$rqVerif ="SELECT idClient, nom, prenom, password, role FROM clients WHERE email = :email";
		//preparation
		$stmtVerif = $dbh->prepare($rqVerif);
		//parametres
		$params = array(':email' => $safe['email']);
		//exectuion
		if($stmtVerif->execute($params)){
			//recuperation
			$client = $stmtVerif->fetch();
			//verification mot de passe
			if(password_verify($safe['password'], $client['password'])){
				//changement n° session (sécurité)
				session_regenerate_id();
				//enregistrement
				$_SESSION['id'] = $client['idClient'];
				$_SESSION['nom'] = $client['nom'];
				$_SESSION['prenom'] = $client['prenom'];
				$_SESSION['auth'] = 'ok'; //pour le menu
				$_SESSION['role'] = $client['role'];
				//message de bienvenue
				$message = "Bienvenue ".$_SESSION['prenom'].' '.$_SESSION['nom'];
			}
			else $message = "Mot de passe incorrect";
		}
		else $message = "email incorrect";
	}
	else $message = "Mot de passe non conforme";
	echo 	'<script>
				alert("'.$message.'");
				window.location.href="index.php";
			</script>';
?>
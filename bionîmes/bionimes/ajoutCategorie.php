<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$libCategorie = strip_tags($_POST['libCategorie']);
	//requete
	$rqAjout ="INSERT INTO categories(libCategorie) VALUES(:libCategorie)";
	//preparation
	$stmtAjout = $dbh->prepare($rqAjout);
	//parametres
	$params = array(':libCategorie' => $libCategorie);
	//execution
	$stmtAjout->execute($params);
	//retour a l'admin
	header('location: administration.php');
?>
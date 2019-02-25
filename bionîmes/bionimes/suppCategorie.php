<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$idCategorie = strip_tags($_GET['id']);
	//requete
	$rqSupp ="DELETE FROM categories WHERE idCategorie = :idCategorie";
	//preparation
	$stmtSupp = $dbh->prepare($rqSupp);
	//parametres
	$params = array(':idCategorie' => $idCategorie);
	//execution
	$stmtSupp->execute($params);
	//retour a l'admin
	header('location: administration.php');
?>
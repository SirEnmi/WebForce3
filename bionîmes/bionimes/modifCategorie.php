<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$safe = array_map('strip_tags', $_POST);
	//requete
	$rqModif ="UPDATE categories SET libCategorie = :libCategorie WHERE idCategorie = :idCategorie";
	//preparation
	$stmtModif = $dbh->prepare($rqModif);
	//parametres
	$params = array(':libCategorie' => $safe['libCategorie'], ':idCategorie' => $safe['idCategorie']);
	//execution
	$stmtModif->execute($params);
	//retour a l'admin
	header('location: administration.php');
?>
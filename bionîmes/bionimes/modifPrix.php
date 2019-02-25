<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$safe = array_map('strip_tags', $_POST);
	//requete
	$rqModifPrix ="UPDATE articles SET prix = :prix WHERE idArticle = :idArticle";
	//preparation
	$stmtModifPrix = $dbh->prepare($rqModifPrix);
	//parametres
	$params = array(':prix' => $safe['prix'], ':idArticle' => $safe['idArticle']);
	//execution
	$stmtModifPrix->execute($params);
	//retour a l'admin
	header('location: administration.php');
?>
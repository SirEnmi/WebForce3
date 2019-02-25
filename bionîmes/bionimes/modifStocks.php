<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$safe = array_map('strip_tags', $_POST);
	//requete
	$rqModifStock ="UPDATE stocks SET quantite = :quantite WHERE idArticle = :idArticle";
	//preparation
	$stmtModifStock = $dbh->prepare($rqModifStock);
	//parametres
	$params = array(':quantite' => $safe['quantite'], ':idArticle' => $safe['idArticle']);
	//execution
	$stmtModifStock->execute($params);
	//retour a l'admin
	header('location: administration.php');
?>
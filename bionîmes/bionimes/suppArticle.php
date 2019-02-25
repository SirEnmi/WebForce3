<?php
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//Mr propre
	$idArticle = strip_tags($_GET['id']);
	//requete
	$rqSuppS ="DELETE FROM stocks WHERE idArticle = :idArticle";
	//preparation
	$stmtSuppS = $dbh->prepare($rqSuppS);
	//parametres
	$params = array(':idArticle' => $idArticle);
	//execution
	if($stmtSuppS->execute($params)){
		$rqSuppA ="DELETE FROM articles WHERE idArticle = :idArticle";
		$stmtSuppA = $dbh->prepare($rqSuppA);
		$stmtSuppA->execute($params);
	}
	//retour a l'admin
	header('location: administration.php');
?>
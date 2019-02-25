<?php
	/* modifPanier.php */
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//mr propre
	$safe = array_map('strip_tags', $_POST);

	//requete
	$rqModif = "UPDATE panier SET quantite = :quantite WHERE idArticle = :idArticle AND idClient = :idClient";
	//preparation
	$stmtModif = $dbh->prepare($rqModif);
	//parametres
	$params = array(':quantite' => $safe['quantite'], ':idArticle' => $safe['idArticle'], ':idClient' => $_SESSION['id']);
	//execution
	$stmtModif->execute($params);
	//retour panier
	header('location: panier.php');
?>
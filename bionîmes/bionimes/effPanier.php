<?php
	/* effPanier.php */
	session_start();
	//connexion BDD
	include 'includes/connexion.php';
	//mr propre
	$idLigne = strip_tags($_POST['idLigne']);

	//requete
	$rqEff = "DELETE FROM panier WHERE idPanier = :idLigne";
	//preparation
	$stmtEff = $dbh->prepare($rqEff);
	//parametres
	$params = array(':idLigne' => $idLigne);
	//execution
	$stmtEff->execute($params);
	//retour panier
	header('location: panier.php');
?>
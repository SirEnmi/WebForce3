<?php
	 /* ajoutPanier.php */
	 session_start();
	 //connexion BDD
	 include 'includes/connexion.php';
	 //mr propre
	 $safe = array_map('strip_tags', $_POST);
	 //verification si produit deja dans le panier
	 //requete
	 $rqVerif = "SELECT COUNT(*) FROM panier WHERE idArticle = :idArticle AND idClient = :idClient";
	 //preparation
	 $stmtVerif = $dbh->prepare($rqVerif);
	 //parametre
	 $params = array(':idArticle' => $safe['idArticle'], ':idClient' => $_SESSION['id']);
	 //execution
	 $stmtVerif->execute($params);
	 //recuperation
	 $exists = $stmtVerif->fetchColumn();
	 echo $exists;
	 //ajout/modification au panier

	 //requete
	 if($exists == 0){
	 	$rqAjout = "INSERT INTO panier(idClient, idArticle, quantite) VALUES(:idClient, :idArticle, :quantite)";
	 }
	 else $rqAjout = "UPDATE panier SET quantite = quantite + :quantite WHERE idClient = :idClient AND idArticle = :idArticle";
	 //preparation
	 $stmtAjout = $dbh->prepare($rqAjout);
	 //parametres
	 $params2 = array(':idClient' => $_SESSION['id'], ':idArticle' => $safe['idArticle'], ':quantite' => $safe['quantite']);
	 //execution
	 $stmtAjout->execute($params2);
	 //retour aux produits dans la bonne catégorie
	 header('location: article.php?cat='.$safe['categorie']);
?>
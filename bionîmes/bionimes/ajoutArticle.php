<?php
	/* ajoutArticle.php */
	session_start();
	//connexion
	include 'includes/connexion.php';
	//mr propre
	$safe = array_map('strip_tags', $_POST);
	//recuperation de la photo
	if($_FILES['photo']['error'] == 0){
		//vérification du type
		$type = new finfo(FILEINFO_MIME_TYPE);
		$info = $type->file($_FILES['photo']['tmp_name']);
		//si c'est un fichier image (PNG, JPG, JPEG, GIF)
		if(substr($info, 0, 5) == 'image'){
			//enregistrement du fichier
			if(move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$_FILES['photo']['name']));{
				//requete
				$rqArticle = "INSERT INTO articles(libelle, prix, conditionnement, idCategorie, description, photo, idProducteur) VALUES(:libelle, :prix, :conditionnement, :idCategorie, :description, :photo, :idProducteur)";
				//preparation
				$stmtArticle = $dbh->prepare($rqArticle);
				//parametre
				$params = array(':libelle' => $safe['libelle'], ':prix' => $safe['prix'], ':conditionnement' => $safe['conditionnement'], ':idCategorie' => $safe['idCategorie'], ':description' => $safe['description'], ':photo' => $_FILES['photo']['name'], ':idProducteur' => $safe['idProducteur']);
				//execution
				if($stmtArticle->execute($params)){
					//recuperation dernier id attribué	
					$idArticle = $dbh->lastInsertId();
					//requete ajout stocks
					$rqStock = "INSERT INTO stocks(idArticle, quantite) VALUES(:idArticle, :quantite)";
					//preparation
					$stmtStock = $dbh->prepare($rqStock);
					//parametres
					$param2 = array(':idArticle' => $idArticle, ':quantite' => $safe['quantite']);
					//execution
					$stmtStock->execute($param2);				
				}

			}
		}
	}

	//retour
	//header('location: administration.php');
?>
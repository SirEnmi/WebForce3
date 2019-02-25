<?php
	/* validePanier.php 
	A faire :
		- lire le panier
		- creation facture
		- dans une boucle
			* creer un fichier CSV => bon de commande
			* creer lesl ignes du panier
			* effacer les lignes du panier
			* modifier les tocks
		- afficher module paypal */
	$titrePage = "Bio Nîmes - validation";
	include 'includes/header.php';
	include 'includes/navbar.php';

	//le client
	$idClient = $_SESSION['id'];
	//le montant de la facture
	$montantTotal = $_SESSION['montantTotal'];
	//recuperer le panier
	$rqPanier = "SELECT idPanier, idArticle, quantite FROM panier WHERE idClient = :idClient";
	//preparation
	$stmtPanier = $dbh->prepare($rqPanier);
	//parametres
	$params = array(':idClient' => $idClient);
	//execution
	$stmtPanier->execute($params);
	//recuperation
	$contenuPanier = $stmtPanier->fetchAll();
	//print_r($contenuPanier);
	if(count($contenuPanier) > 0){
		$rqFacture = "INSERT INTO factures (idClient, dateFacture, montant, idReglement) VALUES (:idClient, NOW(), :montant, 1)";
		//preparation
		$stmtFacture = $dbh->prepare($rqFacture);
		//parametres
		$paramFacture = array(':idClient' => $idClient, ':montant' => $montantTotal);
		//execution
		$stmtFacture->execute($paramFacture);
		//recuperation
		$idFacture = $dbh->lastInsertId();
		//echo '<p>Numéro de Facture: '.$idFacture.'</p>';

		//ouverture fichier CSV (bon de commande)
		$fd = fopen('commandes/panier-'.date('dmYHis').'-'.$idClient.'.csv', 'w');
		//boucle sur le panier
		foreach($contenuPanier as $ligne){
			//ecriture dans le fichier CSV
			fputcsv($fd, $ligne, ';');

			//ecrire dans la table detfactures
			$rqDetail = "INSERT INTO detFactures (idFacture, idArticle, quantite) VALUES (:idFacture, :idArticle, :quantite)";
			//preparation
			$stmtDetail = $dbh->prepare($rqDetail);
			//parametres
			$paramDetail = array(':idFacture' => $idFacture, ':idArticle' => $ligne['idArticle'], ':quantite' => $ligne['quantite']);
			//execution
			if($stmtDetail->execute($paramDetail)){
				//effacer la ligne du panier
				$rqEffPanier = "DELETE FROM panier WHERE idPanier = :idPanier";
				//preparation
				$stmtEffPanier = $dbh->prepare($rqEffPanier);
				//parametres
				$paramEffPanier = array(':idPanier' => $ligne['idPanier']);
				//execution
				$stmtEffPanier->execute($paramEffPanier);

				//modifier les stocks
				$rqModifStock = "UPDATE stocks SET quantite = quantite - :quantite WHERE idArticle = :idArticle";
				//preparation
				$stmtModifStock = $dbh->prepare($rqModifStock);
				//parametres
				$paramModifStock = array(':quantite'=> $ligne['quantite'], ':idArticle' => $ligne['idArticle']);
				//execution
				$stmtModifStock->execute($paramModifStock);
			}
			else echo '<p class="alert alert-danger">Erreur</p>';
		}
		fclose($fd);
		//affichage module paypal
		?>
		<div class="text-center">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name ="business" value="info@ophois.com" />
				<input type="hidden" name="currency_code" value="EUR" />
				<input type="hidden" name="amount" value="<?= $montantTotal; ?>" />
				<input type="hidden" name="invoice" value="<?= $idFacture; ?>" />
				<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" alt="Paypal, le reflexe sécurité pour payer en ligne" />
				<img src ="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" border="0" width="1" height="1" /> 
			</form>
		</div>
	<?php
		}
		include 'includes/footer.php';
	?>
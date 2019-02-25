<?php
	/* panier.php */
	$titrePage = 'Bio Nîmes - Panier';
	include 'includes/header.php';
	include 'includes/navbar.php';

	//requete
	$rqPanier = "SELECT p.idPanier, p.idArticle, p.quantite, a.libelle, a.prix, a.conditionnement, s.quantite as stocks FROM panier as p JOIN articles as a ON p.idArticle = a.idArticle JOIN stocks as s ON p.idArticle = s.idArticle WHERE idClient = :idClient";
	//preparation
	$stmtPanier = $dbh->prepare($rqPanier);
	//parametres
	$params = array(':idClient' => $_SESSION['id']);
	//execution
	$stmtPanier->execute($params);
	//récupération
	$contenuPanier = $stmtPanier->fetchAll();
	//pour verifier print_r($contenuPanier)
	if(count($contenuPanier) == 0){
		echo '<div class="alert alert-info">Votre panier est vide.</div>';
	}
	else {
		//montant total
		$montantTotal = 0;

	?>
	<div class="container" style="margin-top: 2%">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Article</th>
					<th class="">Prix</th>
					<th class="">Quantite</th>
					<th class="text-right">Action</th>
					<th class="text-right">Montant</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($contenuPanier as $ligne ): ?>
					<tr>
						<td><?= $ligne['libelle']; ?></td>
						<td class=" "><?= $ligne['prix']; ?> &euro;/<?= $ligne['conditionnement']; ?></td>
						<td>
							<form method="post" action="modifPanier.php" class="form-inline" >
								<input type="hidden" name="idArticle" value="<?= $ligne['idArticle']; ?>" />
								<input type="number" name ="quantite" class="form-control" value="<?= $ligne['quantite']; ?>" min="0" max="<?= $ligne['stocks']; ?>" />
								<button type="submit" class="btn btn-outline-success"><i class="far fa-edit"></i></button>
							</form>
						</td>
						<td class="text-right">
							<form method="post" action="effPanier.php">
								<input type="hidden" name="idLigne" value="<?= $ligne['idPanier']; ?>" />
								<button type="submit" class="btn btn-outline-danger">
									<i class="far fa-trash-alt"></i>
								</button>
							</form>
						</td>
						<td class="text-right"><?= number_format($ligne['prix'] * $ligne['quantite'], 2, '.', ' '); ?> &euro;</td>
					</tr>
				<?php 
					$montantTotal += ($ligne['prix'] * $ligne['quantite']);
					endforeach;
					$_SESSION['montantTotal'] = $montantTotal;
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right">Total: </td>
					<td class="text-right"><?= number_format($montantTotal, 2, '.', ' '); ?>&euro;</td>
				</tr>
			</tfoot>
		</table>
		<div class="text-right">
			<a href="validePanier.php" class="btn btn-outline-success">
				Valider
			</a>
		</div>
	</div>

	<?php
	} //fin else
	include 'includes/footer.php'
?>
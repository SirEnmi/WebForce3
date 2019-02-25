<?php
	//administration.php
	$titrePage ='Bio Nîmes - Page pour l\'admin';
	include 'includes/header.php';
	include 'includes/navbar.php';

	//liste des catégories
	$rqCat = "SELECT * FROM categories";
	//query car aucun parametres
	$listeCategories = $dbh->query($rqCat)->fetchAll();

	//liste des producteurs
	$rqProd = "SELECT * FROM producteurs";
	//query car aucun parametres
	$listeProd = $dbh->query($rqProd)->fetchAll();

	//liste des produits (avec le stock)
	$rqArticles = "SELECT a.idArticle, a.libelle, a.prix, s.quantite FROM articles as a JOIN stocks as s ON a.idArticle = s.idArticle";
	//query car aucun parametres
	$listeArticles = $dbh->query($rqArticles)->fetchAll();
	//autres listes
?>
<div class="row">
	<div class="col-md-6">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Catégorie</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($listeCategories as $cat): ?>
					<tr>
						<td><?= $cat['idCategorie']; ?></td>
						<td>
							<form method="post" action="modifCategorie.php" class="form-inline">
								<input type="hidden" name="idCategorie" value="<?= $cat['idCategorie']; ?>" />
								<input type="text" name="libCategorie" class="form-control" value="<?= $cat['libCategorie']; ?>" />
								<button type="submit" class="btn btn-outline-success mb-2"><i class="far fa-edit"></i></button>
							</form>
						</td>
						<td>
							<a href="suppCategorie.php?id=<?= $cat['idCategorie']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td colspan="2" class="text-center">
						<form method="post" action="ajoutCategorie.php" class="form-inline">
							<input type="text" name="libCategorie" class="form-control" />
							<button type="submit" class="btn btn-primary"><i class="far fa-save"></i></button>
						</form>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class ="col-md-6">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Article</th>
					<th>Prix</th>
					<th>Stocks</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($listeArticles as $articles): ?>
					<tr>
						<td><?=$articles['idArticle']; ?></td>
						<td><?=$articles['libelle']; ?></td>
						<td>
							<form method="post" action="modifPrix.php" class="form-inline">
								<input type="hidden" name="idArticle" value="<?= $articles['idArticle']; ?>" />
								<input type="text" name="prix" value="<?= $articles['prix']; ?>" class="form-control" />
								<button type="submit" class="btn btn-sm btn-warning">
									<i class="far fa-edit"></i>
								</button>
							</form>
						</td>
						<td>
							<form method="post" action="modifStocks.php" class="form-inline">
								<input type="hidden" name="idArticle" value="<?= $articles['idArticle']; ?>" />
								<input type="number" name="quantite" value="<?= $articles['quantite']; ?>" class="form-control" />
								<button type="submit" class="btn btn-sm btn-warning">
									<i class="far fa-edit"></i>
								</button>
							</form>
						</td>
						<td>
							<a href="suppArticle.php?id=<?= $articles['idArticle']; ?>" class="btn btn-sm btn-danger">
								<i class="far fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<form method="post" action="ajoutArticle.php" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nom</label>
				<input type="text" name="libelle" class="form-control" />
			</div>
			<div class="form-group">
				<label>Prix</label>
				<input type="text" name="prix" class="form-control" />
			</div>
			<div class="form-group">
				<label>Conditionnement</label>
				<input type="text" name="conditionnement" class="form-control" />
			</div>
			<div class="form-group">
				<label>Stock</label>
				<input type="text" name="quantite" class="form-control" />
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control"></textarea>
			</div>

			<div class="form-group">
				<label>Photo</label>
				<input type="file" name="photo" class="form-control">
			</div>
			<div class="form-group">
				<label>Catégorie</label>
				<select name="idCategorie" class="form-control">
					<?php 
						foreach ($listeCategories as $cat) {
							echo '<option value="'.$cat['idCategorie'].'">'.$cat['libCategorie'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Producteur</label>
				<select name="idProducteur" class="form-control">
					<?php 
						foreach ($listeProd as $prod) {
							echo '<option value="'.$prod['idProducteur'].'">'.$prod['RS'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="text-center">
				<input type="submit" value="Ajouter" class="btn btn-primary" />
				<!-- <button type="submit" class="btn btn-primary"><i class="far fa-save"></i></button> -->
			</div>
		</form>
	</div>
</div>

<?php
	include 'includes/footer.php';
?>
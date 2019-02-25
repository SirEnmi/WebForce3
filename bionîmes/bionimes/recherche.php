<?php
	/* recherche.php */
	$titrePage = 'Bio Nîmes - Rechercher un article';
	include 'includes/header.php';
	include 'includes/navbar.php';

	//mr propre
	$recherche = strip_tags($_POST['recherche']);
	//requete de recherche en fonction d'un morceau du libelle
	$rqArticle = "SELECT a.idArticle, a.libelle, a.prix, a.conditionnement, a.description, a.photo, p.pays, s.quantite FROM articles as a JOIN producteurs as p ON a.idproducteur = p.idProducteur JOIN stocks as s ON a.idArticle = s.idArticle WHERE a.libelle LIKE ?";
	//preparation
 	$stmtRecherche = $dbh->prepare($rqArticle);
	//parametres
 	$paramRecherche = array('%'.$recherche.'%');
	//execution
 	$stmtRecherche->execute($paramRecherche);
	//recuperation d'une liste de produits
	$listeArticles = $stmtRecherche->fetchAll();
?>

<div class="container">
	<div class="row">
		<?php foreach($listeArticles as $article) : ?>
		<div class="card col-md-4">
			<?php
	            if($article['quantite'] > 0){
	                $photo = 'images/'.$article['photo'];
	            }
	            else $photo = 'images/outofstock.png';
	        ?>
	        <img src="<?= $photo; ?>" class="card-img-top" alt="<?= $article['libelle']; ?>"/>
			<div class="card-body">
				<h4 class="cart-title"><?= $article['libelle']; ?></h4>
				<ul class="list-group">
					<li class="list-group-item">
						<?= $article['description']; ?>
					</li>
					<li class="list-group-item">
						<?= $article['prix']; ?>&euro;
						<?= $article['conditionnement']; ?>
					</li>
					<li class="list-group-item">
						Origine: <? = $article['pays']; ?>
					</li>
					<li class="list-group-item">
						<?php
						if(isset($_SESSION['auth'])){
							if($article['quantite'] > 0){
						?>
								<form method="post" action ="ajoutPanier.php" class="inline-form">
									<input type="hidden" name="categorie" value="<?= $idCategorie; ?>" />
									<input type="hidden" name="idArticle" value="<?= $article['idArticle']; ?>" />
									<div class="row">
										<input type="number" name="quantite" min="0" max="<?= $article['quantite'] ?>" class="form-control col-md-8" />
										<input type="submit" value="Ajouter" class="btn btn-outline-success mb-2" />
									</div>
								</form>
						<?php
							}
							else echo '<p class="text-center"><em>en cours de réapprovisionnement</em></p>';
						}
						else 
						{
						echo 	'<p class="text-center">
									<em>Vous devez être connecté pour commander</em>
								</p>';
						}
						?>
					</li>
				</ul>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>

<?php
	include 'includes/footer.php';
?>
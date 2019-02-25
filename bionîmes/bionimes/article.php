<?php
	//article.php
	$titrePage = "Bio Nîmes - nos produits";
	include 'includes/header.php';
	include 'includes/navbar.php';

	//mr propre
	$idCategorie = strip_tags($_GET['cat']);
	//requete pour récupérer le nom de la catégorie
	$rqCategorie = "SELECT libCategorie FROM categories WHERE idCategorie = :idCategorie";
	//preparation
	$stmtCategorie = $dbh->prepare($rqCategorie);
	//parametres
	$params = array(':idCategorie' => $idCategorie);
	//execution
	$stmtCategorie->execute($params);
	//recuperation (1 unique valeur)
	$libCat = $stmtCategorie->fetch();
	//print_r($libCat);

	//requete pour recuperer la liste des produits de la catégorie
	$rqListe = "SELECT a.idArticle, a.libelle, a.prix, a.conditionnement, a.description, a.photo, p.pays, s.quantite
    FROM articles as a
    JOIN producteurs as p
    ON a.idProducteur = p.idProducteur
    JOIN stocks as s
    ON a.idArticle = s.idArticle
    WHERE a.idCategorie = :idCategorie";
	//préparation
	$stmtListe = $dbh->prepare($rqListe);
	//execution
	$stmtListe->execute($params);
	//recuperation (plusieurs enregistrement)
	$listeArticle = $stmtListe->fetchAll();
	//affichage
	//echo '<pre>';
	//print_r($listeArticle);
	//echo '</pre>';
?>

<div class="container">
	<div class="row">
		<?php foreach($listeArticle as $article) : ?>
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
	include 'includes/footer.php'
?>
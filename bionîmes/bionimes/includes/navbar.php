<?php
	$rqCategories = "SELECT * FROM categories";
	$stmtCategories = $dbh->query($rqCategories);
	$listeCategories = $stmtCategories->fetchAll();

	if(isset($_SESSION['auth'])){
		$rqNbPaniers = "SELECT COUNT(idPanier) FROM panier WHERE idClient = :idClient";
		$stmtNbPaniers = $dbh->prepare($rqNbPaniers);
		$params = array(':idClient' => $_SESSION['id']);
		$stmtNbPaniers->execute($params);
		$NbPaniers = $stmtNbPaniers->fetchColumn();
	}
	//print_r($NbPaniers);

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#monMenu" aria-controls="monMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="monMenu">
    <ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a href="#"  class="nav-link dropdown-toggle" data-toggle="dropdown" id="listProduits" aria-haspopup="true" aria-expended="false">Articles</a>
				<div class="dropdown-menu" arai-labelledby="listeProduits">
					<!-- boucle -->
					<?php
						foreach ($listeCategories as $cat){
							echo '<a href="article.php?cat='.$cat['idCategorie'].'" class="dropdown-item">'.$cat['libCategorie'].'</a>';
						}
					?>
				</div>
			</li>
			<?php if(isset($_SESSION['auth'])): ?>
			<li class="nav-item">
				<a href="panier.php"  class="nav-link">
					<?php
						if($NbPaniers > 0){
							echo 'Panier <span class="badge badge-primary">'.$NbPaniers.'</span>';
						}
						else echo 'Panier';
					?>
				</a>
			</li>
			<li class="nav-item">
				<a href="deconnexion.php"  class="nav-link">Deconnexion</a>
			</li>
			<?php if($_SESSION['role'] == 1): ?>
				<li class="nav-item">
					<a class="nav-link" href="administration.php">Administration</a>
				</li>
			<?php
				endif;
				else: ?>
			<li class="nav-item">
				<a href="inscription.php"  class="nav-link">Inscription</a>
			</li>
			<li class="nav-item">
				<a href="connex.php"  class="nav-link">Connexion</a>
			</li>
			<?php endif; ?>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="contact.php"  class="nav-link">Contacts</a>
			</li>
		</ul>
		<form class="form-inline" method="post" action="recherche.php">
			<input type="text" name="recherche" placeholder="article" aria-label="article" class="form-control mr-sm2" id="rechercheArticle" />
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="btnSearch">Chercher</button>
		</form>
	</div>
</nav>
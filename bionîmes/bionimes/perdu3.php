<?php
	/* perdu3.php */
	$titrePage = 'Bio Nîmes - Modification du mot de passe';
	include 'includes/header.php';
  	include 'includes/navbar.php';

  	//mr propre
  	$token = strip_tags($_GET['token']);
  	//requete
  	$rqId = "SELECT idClient FROM clients WHERE token = :token";
  	//preparation
  	$stmtToken = $dbh->prepare($rqId);
  	//parametres
  	$params = array(':token' => $token);
  	//execution
  	$stmtToken->execute($params);
  	//recuperation
  	$idClient = $stmtToken->fetchColumn();

  	if($idClient !== false){
  		?>
  		<div class="row justify-content-center">
    		<form action="perdu4.php" method="post" class="col-lg-6">
    			<input type="hidden" name="idClient" value="<?= $idClient; ?>" />
       			<div class="form-group">
            		<label>Mot de passe</label>
            		<input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe" required>
        		</div>
        		<div class="form-group">
            		<label>confirmation du mot de passe</label>
            		<input type="password" name="password2" class="form-control" placeholder="Répetez votre nouveau mot de passe" required>
        		</div>
        		<div class="text-center">
					<input type="submit" value="Modifier" class="btn btn-outline-success" />
				</div>
	 		</form>	
		</div>
  		<?php
  	}
  	else echo '<p class="alert alert-danger">Erreur de token</p>';
  	include 'includes/footer.php';
?>
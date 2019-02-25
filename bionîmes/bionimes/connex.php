<?php
	/* connexion.php */
	$titrePage = "Bio Nîmes - Connexion";
	include 'includes/header.php';
	include 'includes/navbar.php';
?>

<div class="container justify-content-center">
	<form action="login.php" method="post" class="col-lg-6">
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control" placeholder="Votre mail" required />
		</div>
		<div class="form-group">
			<label>Mot de passe</label>
			<input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required />
		</div>
		<div class="form-group text-center">
			<input type="submit" name="btnSub" class="btn btn-verify" value="Connexion" />
		</div>
		<div class="text-center">
        	<a href="perdu.php" target="_blank">Mot de passe oublié</a>
        </div>
	</form>
</div>

<?php
	include 'includes/footer.php';
?>

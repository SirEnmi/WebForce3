<?php
	$titrePage = "Bio Nîmes - Inscription";
	include 'includes/header.php';
	include 'includes/navbar.php';
?>
<div class="container justify-content-center">
	<form action="ajoutClient.php" method="post" class="col-lg-6">
		<div class="form-group">
			<label>Nom</label>
			<input type="text" name="nom" class="form-control" placeholder="Votre nom" required />
		</div>
		<div class="form-group">
			<label>Prenom</label>
			<input type="text" name="prenom" class="form-control" placeholder="Votre prenom" required />
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control" placeholder="Votre mail" required />
		</div>
		<div class="form-group">
			<label>Mot de passe</label>
			<input type="password" name="password" class="form-control" placeholder="8 caractères mninmum dont un chiffre et une majuscule" required />
		</div>
		<div class="form-group">
			<label>Téléphone</label>
			<input type="text" name="tel" class="form-control" placeholder="Votre numéro de téléphone" required />
		</div>
		<div class="form-group">
			<label>Adresse</label>
			<input type="text" name="adresse" class="form-control" placeholder="Votre adresse" required />
		</div>
		<div class="form-group">
			<label>Code Postal</label>
			<input type="text" name="cp" class="form-control" placeholder="Code Postal" maxlength="5" required />
		</div>
		<div class="form-group">
			<label>Ville</label>
			<input type="text" name="ville" class="form-control" placeholder="Ville" required />
		</div>
		<div class="form-group">
			<label>Acceptez-vous que Bio Nîmes utilise votre adresse email pour vous evoyer des promotions (cette adresse ne sera ni partagée avec des partenaiares, ni vendue) ?</label>
			<input type="checkbox" name="consentement" class="form-control" required />
		</div>
		<div class="form-group">
			<input type="submit" name="btnSub" class="btn btn-success" value="S'inscrire" />
		</div>
	</form>
</div>

<?php
	include 'includes/footer.php';
?>

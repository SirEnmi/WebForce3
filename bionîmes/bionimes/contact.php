<?php
	/* contact.php */
	$titrePage = "Bio Nîmes - Contactez nous";
	include 'includes/header.php';
	include 'includes/navbar.php';
?>
<div class="row justify-content-center container">
	<form action="contact2.php" method="post" class="col-lg-6">
		<div class="form-group">
			<label class="obligatoire">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Votre Email (ex: dupond.michael@gmail.com)" required>
		</div>
		<div class="form-group">
			<label class="obligatoire">Nom</label>
			<input type="text" name="nom" class="form-control" placeholder="Votre nom (ex: Dupond)" required>
		</div>
		<div class="form-group">
			<label class="obligatoire">Prenom</label>
			<input type="text" name="prenom" class="form-control" placeholder="Votre prenom (ex: Michael)" required>
		</div>
		<div class="form-group">
			<label class="obligatoire">Message</label>
			<textarea name="message" rows="10" class="form-control" required></textarea>
		</div>
		<div class="text-center">
			<input type="submit" value="Envoyer" class="btn btn-outline-success" />
		</div>
		<p>
			<span class="obligatoire"></span>
			<em>Champs obligatoire</em>
		</p>
	</form>
</div>

<?php
	include 'includes/footer.php';
?>
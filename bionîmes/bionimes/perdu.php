<?php
  $titrePage = "Bio Nîmes - Mot de passe perdu";
  include 'includes/header.php';
  include 'includes/navbar.php';
?>
<div class="row justify-content-center">
    <form action="perdu2.php" method="post" class="col-lg-6">

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" 
                   placeholder="Votre adresse mail" required>
        </div>
        		<div class="text-center">
			<input type="submit" name="btnSub" Value="Mot de passe oublié"
						 class="btn btn-outline-success" />
		</div>
	 </form>	
</div>
<?php
include 'includes/footer.php';
?>
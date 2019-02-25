<?php
	//tjrs en haut
	session_start();
	//connexion BDD
	include "connexion.php";
?>

<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<meta http-equiv="X-UE-Compatible" content="IE-Edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?= $titrePage; ?></title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</HEAD>
	<BODY>
		<div class="container">
			<header>
				<div class="row">
					<div class="col-md-4">
						<img src="images/logo.jpg" alt="Bio Nîmes" class="logo" />
					</div>
					<div class="col-md-8">
						<hgroup>
							<h1>Bio Nîmes</h1>
							<h2>Votre épicerie bio à Nîmes</h2>
						</hgroup>
					</div>
				</div>
			</header>			
		</div>

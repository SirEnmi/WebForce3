<?php
	/* connexion à la BDD bionimes */
	$dbh = new PDO('mysql:host=localhost;dbname=bionimes;charset=utf8', 'root', '');
	//on force le tableau associatif pour tous les résultat de requêtes
	$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	//affichage des erreurs SQL (DEBUG pendant le développement)
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>
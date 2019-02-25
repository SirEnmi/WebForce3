<?php
	/* deconnexion.php */
	session_start();
	//destruction des variables de session
	session_unset();
	//destruction de la session
	session_destroy();
	//retour à la page d'acceuil
	header('location: index.php');
?>
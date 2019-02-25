<?php
	/* contact2.php */
	$titrePage = "Bio Nîmes - Contactez nous";
	include 'includes/header.php';
	include 'includes/navbar.php';
	//bibliotheque PHPMailer
	include 'includes/phpmailer/PHPMailerAutoload.php';

	//mr propre
	$safe = array_map('strip_tags', $_POST);
	//creation d'un objet mail
	$mail = new PHPMailer;
	//parametrage du mail
	$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
	//$mail->SMTPDebug =3; //mode debug si > 2
	$mail->isSMTP(); //connexion directe à un serveur SMTP
	$mail->isHTML(true); //mail au format HTML
	$mail->Host = 'smtp.gmail.com'; //serveur de messagerie
	$mail->SMTPAuth = true; //on va fournir un login/pwd au serveur
	$mail->Port = 465; //port utilisé par le serveur
	$mail->SMTPSecure = 'ssl'; //type de certificat utilisé
	$mail->Username = 'wf3nimes@gmail.com'; //login pour le serveur
	$mail->Password = 'Azerty1234'; //le mdp du serveur
	$mail->addAddress('emilin.meissonnier@gmail.com'); //le destinataire
	$mail->Setfrom('wf3nimes@gmail.com', 'Bio Nîmes'); //l'expediteur
	$mail->Subject ='Message de '.$safe['email']; //le sujet du mail
	$mail->Body = '	<html>
					<head>
					<style>
					h1{color: green; }
					</style>
					</head>
					<body>
						<h1>Message de '
						.$safe['email']
						.'</h1>
						<p>'
						.$safe['prenom']
						.' '
						.$safe['nom']
						.'</p>
						<p>'
						.$safe['message']
						.'</p>
						</body>
						</html>'; //le contenu du mail en html
	//si envoi OK
	if($mail->send()){
		echo '<p class="alert alert-success">Votre mail a été envoyé.</p>';
	}
	else{
		echo '<p class="alert alert-danger">ERREUR '.$mail>ErrorInfo.'</p>';
	}

	include 'includes/footer.php';
?>
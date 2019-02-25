<?php
//perdu2.php
$titrePage ='Bio Nîmes - Mot de passe perdu';

include 'includes/header.php';
include 'includes/navbar.php';

//nettoyage

$email = strip_tags($_POST['email']);

//verif que l'adresse mail est dans la base
$rqVerif ="SELECT COUNT(email)
        FROM clients
        WHERE email = :email";
//preparation
$stmtVerif = $dbh->prepare($rqVerif);

//parametres
$params = array(':email'=> $email);

//execution
$stmtVerif->execute($params);

//recuperation d'une valeur unique
$exists = $stmtVerif->fetchColumn();

//si le client existe
if($exists ==1){
    //generation d'un token
   include 'includes/phpmailer/PHPMailerAutoload.php';
    
    //création objet mail
    $mail = new PHPMailer;
    
    //paramétrage mail
    $mail->SMTPOptions = array(
        'ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>true)
    );
    
    //$mail->SMTPDebug = 3; //mode Debug si >2
    $mail->isSMTP(); //connexion directe à un serveur SMTP
    $mail->isHTML(true); // mail au format HTML
    $mail->Host = 'SMTP.gmail.com'; //serveur de messagerie
    $mail->SMTPAuth = true; //on va fournir un login/pwd au serveur
    $mail->Port = 465; //port tilisé par le serveur
    $mail->SMTPSecure = 'ssl';//type de certificat utilisé
    $mail->Username = "wf3nimes@gmail.com";//login pour le serveur
    $mail->Password = 'Azerty1234';//mot de passe du serveur
    $mail->Setfrom('wf3nimes@gmail.com', 'Bio Nîmes');//expediteur
    $mail->AddAddress($email); //le destinataire
    $mail->Subject = 'Bio Nîmes - Récupération mot de passe'; //sujet du mail
    $token = md5($email.date('YmdHids'));
    $mail->Body ='<html>
    <head>
        <style>
        h3{color:green;}
        </style>
    </head>
    <body>
       <h3>Mot de passe perdu</h3>
       <p><a href="http://'
        .$_SERVER['SERVER_NAME']
        .'/php/bionimes/perdu3.php?token='
        .$token
        .'">Réinitialiser mot de passe</a></p>
    </body>
    </html>';
    
    //envoi du mail
    if(!$mail->Send()){//si l'envoi délire
        echo'<p class="alert alert-warning">Erreur mail :'
            .$mail->ErrorInfo
            .'</p>';

    }else{ //si mail envoyé
        
        //stockage dans la BDD client
        $rqToken = "UPDATE clients
                    SET token = :token
                    WHERE email = :email";
        
        //preparation
    $stmtToken =$dbh->prepare($rqToken);
        
        //parametres
        $param2 = array(':token' => $token,
                       ':email' => $email);
        //execution
        $stmtToken->execute($param2);
        
        //message de retour
        echo'<p class="alert alert-success">
                Vérifiez votre boîte mail...
                </p>';
    }//fin else envoi
}//fin if exists
else echo'<div class="alert alert-danger">
            Votre adresse mail est inconnue...
            </div>';

include 'includes/footer.php';
?>
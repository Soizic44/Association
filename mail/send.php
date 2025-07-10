<?php
//Entête
header('Content-type:application/json');
include('../mail/mail.php');

//Vérification des entrés issues du formulaire
//Vérification que les diférents champs sont correctement rempli 
if (empty($_POST['nom'])) {
    $msg = "Veuillez saisir votre nom !";
    $success = false;
} else if (empty($_POST['prenom'])) {
    $msg = "Veuillez saisir votre prénom !";
    $success = false;
} else if (empty($_POST['societe'])) {
    $msg = "Veuillez saisir votre nom de société !";
    $success = false;

    //Vérification que l'adresse est correcte
} else if (!preg_match("^[^\s@]+@[^\s@]+\.[^\s@]+$", $_POST['email'])) {
    $msg = "L'adresse mail entrée est incorrecte !";
    $success = false;

} else if (empty($_POST['email'])) {
    $msg = "Veuillez saisir votre email !";
    $success = false;

} else if (empty($_POST['message'])) {
    $msg = "Veuillez saisir votre message !";
    $success = false;

} else {
    $dataNom = strip_tags(trim($_POST['nom']));
    $dataPrenom = strip_tags(trim($_POST['prenom']));
    $dataSociete = strip_tags(trim($_POST['societe']));
    $dataObjet = strip_tags(trim($_POST['objet']));
    $dataMail = strip_tags(trim($_POST['email']));
    $dataMsg = strip_tags(trim($_POST['message']));

    // Instanciation de la class Mail
    $mail = new Mail($dataNom, $dataPrenom, $dataSociete, $dataObjet, $dataMail, $dataMsg);

    if($mail->envoiMail()) {
        $msg = "Votre mail a été envoyé avec succès";
        $success = true;
    } else {
        $msg = "Une erreur est survenue !";
        $success = false;
    }
}


//Retourner la réponse en JSON
echo json_encode([
    'valid' => $success,
    'message' => $msg
]);
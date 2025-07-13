<?php
//Entête
header('Content-type:application/json');
include('mail.php');

//Vérification des entrés issues du formulaire
//Vérification que les diférents champs sont correctement rempli 
if(empty($_POST["nom"]) && ($_POST["prenom"]) && ($_POST["societe"]) && ($_POST["objet"]) && ($_POST["message"])) {
    $erreur = "Veuillez saisir votre nom !";
    $success = false;

    //Vérification que l'adresse est correcte
} else if (!preg_match("^[^\s@]+@[^\s@]+\.[^\s@]+$", $_POST["email"])) {
    $erreur = "L'adresse mail entrée est incorrecte !";
    $success = false;

} else {
    $dataNom = strip_tags(trim($_POST["nom"]));
    $dataPrenom = strip_tags(trim($_POST["prenom"]));
    $dataSociete = strip_tags(trim($_POST["societe"]));
    $dataObjet = strip_tags(trim($_POST["objet"]));
    $dataMail = strip_tags(trim($_POST["email"]));
    $dataErreur = strip_tags(trim($_POST["message"]));

    // Instanciation de la class Mail
    $jsonData = file_get_contents("php://input");
    $mail = new Mail($dataNom, $dataPrenom, $dataSociete, $dataObjet, $dataMail, $dataErreur);

    if($mail->envoiMail()) {
        $erreur = "Votre mail a été envoyé avec succès";
        $success = true;
    } else {
        $erreur = "Une erreur est survenue !";
        $success = false;
    }
}

//Retourner la réponse en JSON
echo json_encode([
    "valid" => $success,
    "message" => $erreur
]);


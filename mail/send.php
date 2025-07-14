<?php
//Entête
header('Content-type:application/json');
include '../mail/mail.php';

//Vérification des entrés issues du formulaire
//Vérification que les diférents champs sont correctement rempli 
if(isset($_POST['submit'])){
    if(empty($_POST["nom"]) || ($_POST["prenom"]) || ($_POST["societe"]) || ($_POST["objet"]) || ($_POST["message"])) {
        $msg = "Veuillez remplir tous les champs !";
        $valid = false;

    //Vérification que l'adresse est correcte
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $msg = "L'adresse mail entrée est incorrecte !";
        $valid = false;

    } else {
        $dataNom = strip_tags(trim($_POST["nom"]));
        $dataPrenom = strip_tags(trim($_POST["prenom"]));
        $dataSociete = strip_tags(trim($_POST["societe"]));
        $dataObjet = strip_tags(trim($_POST["objet"]));
        $dataMail = strip_tags(trim($_POST["email"]));
        $dataMsg = strip_tags(trim($_POST["message"]));

        // Instanciation de la class Mail
        $jsonData = file_get_contents("php://input");
        $mail = new Mail($dataNom, $dataPrenom, $dataSociete, $dataObjet, $dataMail, $dataMsg);

        if($mail->envoiMail()) {
            echo "Votre mail a été envoyé avec succès";
            $valid = true;
        } else {
            echo "Une erreur est survenue !";
            $valid = false;
        }
    }
}


//Retourner la réponse en JSON
echo json_encode([
    'valid' => $valid,
    'message' => $msg
]);


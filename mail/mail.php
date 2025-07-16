<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail du refuge de l'espoir</title>
    <meta name="description" content="contactez notre association : Le refuge de l'espoir">
    <link rel="icon" href="/assets/Logo refuge.png" sizes="114x114" type="image/png">
</head>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Déclaration des variables
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $societe = htmlspecialchars($_POST['societe']);
    $objet = htmlspecialchars($_POST['objet']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $msg = ['msg'];

    //Vérification des entrés issues du formulaire
    //Vérification que les diférents champs sont correctement rempli 
    
    if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
        $msg = "Tous les champs sont obligatoires.";
        $success = false;
        echo "Tous les champs sont obligatoires.";
        exit;

        //Vérification que l'adresse email est correcte
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $msg = "L'adresse mail entrée est incorrecte !";
        $success = false;
        exit;

    } else {
        $success = true;
        //formatage du message envoyé par mail
        $destinataire = "fetiveau.soizic1@hotmail.fr";
        $from = $email;
        $sujet = 'Nouveau message';

        $headers = "Content-type: text/html; charset=UTF-8\n";
        $headers = "From: $nom <$email>";

        $message = "
            Un nouveau message en provenance, du site web : le refuge de l'espoir, est arrivé.
                
                Nom : $nom
                Prénom : $prenom
                Société : $societe
                Email: $email

                Objet : $objet

            Message: $message
        ";
        //envoi des données saisies par mail
        if (mail($destinataire, $sujet, $message, $headers)) {
            echo "Votre message a été envoyé avec succès.";
        }else{
            echo "erreur : votre message n'a pas pu être envoyé";
        }   
    }
}
?>
</html>










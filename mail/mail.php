<?php
$email_admin = "fetiveau.soizic1@gmail.com";
$objet = "Contact via le site web de l'Association";

$_POST["envoyer"];

if(isset($_POST["envoyer"]) && !empty($_POST["envoyer"])){
    if(isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["message"]) && !empty($_POST["message"])){
            
        $message = $_POST["message"];
        $headers = 'From: '. $_POST["email"] . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

        if(mail($email_admin, $objet, $message, $headers)){
            return header("location:formulaire.php?success");
        } 
    } 
}
header("location:formulaire.php?success");

?>


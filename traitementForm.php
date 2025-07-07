<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["text"];
        
        // Here you would typically process the form data, e.g., save to a database or send an email.
        echo "Merci, $name! Votre message a bien été envoyé.";
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }




?>
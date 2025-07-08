<?php

    $email_admin = "fetiveau.soizic@hotmail.fr";
    $objet = "Contact via site web 'Le refuge de l'espoir'";

    // si le bouton "Envoyer" est cliqué
    if(isset($_POST['envoyer'])){
  
    //on vérifie que le champ mail est correctement rempli (empty permet à la fois de savoir si isset() et s'il est pas vide, pratique)
    if(empty($_POST['mail'])) {
        echo "<p>Le champ mail est vide.</p>";
  
    //on vérifie que l'adresse est correcte
    //en savoir plus sur la regex utilisée : https://www.c2script.com/scripts/verifier-une-adresse-mail-en-php-s2.html
    }elseif(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i", $_POST['mail'])){
    
        echo "<p>L'adresse mail entrée est incorrecte.</p>";
  
    //on vérifie que le champ sujet est correctement rempli
    }elseif(empty($_POST['sujet'])){
    
        echo "<p>Le champ sujet est vide.</p>";
  
    //on vérifie que le champ message n'est pas vide
    }elseif(empty($_POST['message'])){
    
        echo "<p>Le champ message est vide.</p>";
  
    //tout est correctement renseigné, on envoi le mail
    }else{


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
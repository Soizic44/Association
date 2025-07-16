<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réponse formulaire au refuge de l'espoir</title>
    <meta name="description" content="contactez notre association : Le refuge de l'espoir">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/assets/Logo refuge.png" sizes="114x114" type="image/png">
</head>

<body>
    <!--START : header-->
    <header class="header">

        <!--START : navbar-->
        <nav class="navbar">
            <img class="logo" src="/assets/Logo refuge.png" alt="Logo de l'association Le refuge de l'espoir"/>
            <a href="tel:0668369763" target="_blank" class="haeder__button">&#9743;</a>
            
            <!--Création Burger-->
            <label for="btn" class="icon">
                <svg viewBox="0 0 100 80" width="40" height="40">
                    <rect width="100" height="15"></rect>
                    <rect y="35" width="100" height="15"></rect>
                    <rect y="70" width="100" height="15"></rect>
                </svg>
            </label>
            <input type="checkbox" id="btn">
            
            <!--Navigation principale / menu-->
            <ul class="menu">
                <li class="nav-item"><a href="/index.html">Accueil</a></li>
                <li class="nav-item">
                    <label for="btn2" class="deroulant">Adoption </label>
                    <input type="checkbox" id="btn2">
                    
                    <!--1er sous-menu-->
                    <ul class="dropdown">
                        <li class="drop-item"><a href="/pages/chiens.html">Nos chiens</a></li>
                        <li class="drop-item"></li><a href="/pages/chats.html">Nos chats</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <label for="btn3" class="deroulant">Nous aider </label>
                    <input type="checkbox" id="btn3">
                    
                    <!--2eme sous-menu-->
                    <ul class="dropdown">
                        <li class="drop-item"><a href="/pages/formulaire.html">Devenir FA / Adhérent(e)</a></li>
                        <li class="drop-item"></li><a href="/pages/dons.html">Faire un don</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="/pages/evenements.html">Evènements</a></li>
                <li class="nav-item"><a href="/pages/contact.html">Contact</a></li>
            </ul>
        </nav>
        <!--END : Navbar-->

    </header>
    <!--END : header-->

    
     <!--START : main-->
    <main class="main">
        <!--START : hero-->
        <section class="pad margeTop">
            <h1>Le refuge de l'espoir</h1>
            <h2 class="h2__hero">Soins et protection animale</h2>
            <div class="image__mail"></div>
        </section>
        <!--END : hero-->

        <!--START : Contact-->
        <section>
            <h2 class="titre_h2">Réponse formulaire de contact envoyé par mail</h2>
        </section>
        <!--END : Contact-->

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
    //Vérification que les différents champs sont correctement rempli 
    
    if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
        $success = false;
        exit;

        //Vérification que l'adresse email est correcte
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        echo "L'adresse mail entrée est incorrecte !";
        $success = false;
        exit;

    } else {
        $success = true;

        //formatage du message envoyé par mail
        $destinataire = "fetiveau.soizic1@hotmail.fr";
        $from = $email . "\r\n" . "Reply-to:" . $email;
        $sujet = 'Nouveau message';

        $headers = "Content-type: text/html; charset=UTF-8\n";
        $headers = "Reply-to: . $email";

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
            echo "<p class='msgMail success'>Votre message a été envoyé avec succès.</p>";
        }else{
            echo "<p class='msgMail error'>! Erreur : votre message n'a pas pu être envoyé !</p>";
        }  
    }
}
?>
    </main>
    <!--END : main-->

    <!--START : footer-->
    <footer id="copyright" class="footRepForm">
            <p>Copyright © 2024 Le refuge de l'espoir <br>/ Tous droits réservés</p>
    </footer>
    <!--END : footer-->
</body>
</html>










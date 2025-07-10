<?php
//Déclaration des proprétés
class Mail {
    private $nom;
    private $prenom;
    private $societe;
    private $objet;
    private $email;
    private $message;
    private $destinataire;

    //Affectation du contenu du formulaire
    public function __construct($nom, $prenom, $societe, $objet, $email, $message, $destinataire='fetiveau.soizic@hotmail.fr') {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->societe = $societe;
        $this->objet = $objet;
        $this->email = $email;
        $this->message = $message;
        $this->destinataire = $destinataire;
    }

    public function envoiMail() {
        $expediteur = 'noreply@refugedelespoir.fr';
        $sujet = 'Nouveau message';

        $header = "Content-type: text/hyml; charset=UTF-8\r\n";
        $header .= "FROM: $expediteur\r\n";

        $message = '
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/mail/mail.css">
                <title>Nouveau message de contact</title>
            </head>
            <body>
                <main>
                    <header>
                        <h1>Le refuge de lespoir</h1>
                        <h2>Nouveau message</h2>
                    </header>
                    <article>
                        <p>Un nouveau message en provenance de votre site est arrivé</p>
                        <p><strong>- Nom : </strong>'.$this->nom.'</p>
                        <p><strong>- Prénom : </strong>'.$this->prenom.'</p>
                        <p><strong>- Société : </strong>'.$this->societe.'</p>
                        <p><strong>- Objet : </strong>'.$this->objet.'</p>
                        <p><strong>- Email : </strong>'.$this->email.'</p>
                        <p><strong>- Message : </strong><br>'.nl2br($this->message).'</p>
                    </article>
                </main>
            </body>
            </html> 
        ';
        return mail($this->destinataire, $sujet, $message, $header);
    }
}
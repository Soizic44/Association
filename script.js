// fonction pour popup page "publicité"
function togglePopup(){
    let popup = document.getElementById("overlay-popup");
    popup.classList.toggle("active");
}

// fonctions page "formulaire de contact"
//Implémenter le JS de ma page
const formulaire    = document.getElementById("formulaire");
const inputNom      = document.getElementById("nom");
const inputPrenom   = document.getElementById("prenom");
const inputSociete  = document.getElementById("societe");
const inputObjet    = document.getElementById("objet");
const inputMail     = document.getElementById("email");
const inputMessage  = document.getElementById("message");
const btnValidation = document.getElementById("envoiContact");
const msg           = document.getElementById("formOutput");
const loader        = document.getElementById("loaderContent");

//Appel des fonctions
inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);

//fonction de validation de soumission du formulaire


//fonction permettant de mettre en place le loader de gestion d'attente
document.getElementById("envoiContact").onclick = function(){
    afficheLoader("envoiContact", this.click);
}
function afficheLoader(){
    if(formulaire.envoiContact.click){
        loader.classList.add("active");
    }
    else{
        loader.classList.remove("active");
    } 
}

//Function permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const messageOk = validateRequired(inputMessage);

    if(nomOk && prenomOk && mailOk && messageOk){
        btnValidation.disabled = false;
        msg.textContent = "";
    }
    else{
        btnValidation.disabled = true;
    }
}

function validateRequired(input){
    if(input.value != ''){
        input.classList.add("valid");
        input.classList.remove("invalid");
        return true; 
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        msg.textContent = "Merci de remplir les champs manquants";
        msg.classList.add("invalid");
        return false;
    }
}

//Définir mon regex Email
function validateMail(input){       
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mailContact = input.value;

    if(mailContact.match(emailRegex)){
        input.classList.add("valid");
        input.classList.remove("invalid"); 
        return true;
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        msg.textContent = "Votre adresse email est incorrecte";
        return false;
    }
}

 //méthode permettant d'afficher l'input société si selection "professionnel"
document.getElementById('professionnel').change = function(){ 
    afficheSociete('.professionnel', this.checked); 
} 
function afficheSociete(){
    if (formulaire.professionnel.checked){
        document.getElementById("prof").style.display ="block";
        //Remettre l'attribut d'obligation pour validation "requis" si sélection du radio "professionnel"
        document.getElementById("societe").setAttribute("required","");
    } 
    else{
        document.getElementById("prof").style.display ="null";
    }
}

//méthode permettant de masquer l'input Société si selection "particulier"
document.getElementById('particulier').change = function(){ 
    maskSociete('.particulier', this.checked); 
}
function maskSociete(){
    if (formulaire.particulier.checked){
        document.getElementById("prof").style.display ="none";
        //Retirer l'attribut d'obligation pour validation "requis" si sélection du radio "particulier"
        document.getElementById("societe").removeAttribute("required",""); 
    } 
    else{
        document.getElementById("prof").style.display ="null";
    }
}
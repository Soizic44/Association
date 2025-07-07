// fonction pour popup page "publicité"
function togglePopup(){
    let popup = document.getElementById("overlay-popup");
    popup.classList.toggle("active");
}

// fonctions page "formulaire de contact"
//Implémenter le JS de ma page
const formulaire = document.getElementById("formulaire");
const inputNom = document.getElementById("name");
const inputPrenom = document.getElementById("firstname");
const inputMail = document.getElementById("email");
const inputMessage = document.getElementById("text");
const btnValidation = document.getElementById("envoiContact");

inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const messageOk = validateRequired(inputMessage);

    if(nomOk && prenomOk && mailOk && messageOk){
        btnValidation.disabled = false;
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
        document.getElementById("societe").removeAttribute('required'); 
    } 
    else{
        document.getElementById("prof").style.display ="null";
    }
}

//addEventListener pour récupérer les données du formulaire
btnValidation.addEventListener('click', function(event){
        // Empêche le comportement par défaut du bouton. Permet qu'au clic la page ne se recharge pas et envoi les informations
    event.preventDefault();
    // Récupération des valeurs des champs du formulaire
    let formData = new FormData();
    formData.append("nom", document.getElementById("name").value.trim());
    formData.append("prenom", document.getElementById("firstname").value.trim());
    formData.append("societe", document.getElementById("societe").value.trim());
    formData.append("objet", document.getElementById("objet").value.trim());
    formData.append("email", document.getElementById("email").value.trim());
    formData.append("text", document.getElementById("text").value.trim());

    // Affichage des données dans la console pour vérification
    console.log(formData);
    // Envoi des données du formulaire via AJAX 
});
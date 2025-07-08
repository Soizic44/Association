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
const inputSociete = document.getElementById("societe");
const inputMail = document.getElementById("email");
const inputMessage = document.getElementById("text");
const btnValidation = document.getElementById("envoiContact");
const pub = document.getElementById("publicite");
const formOutput = document.getElementById("formOutput");

inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);

//Fonction ajaxSend (asynchrone)
async function ajaxSend(e) {
    try {
        e.preventDefault();

        //Création d'un nouvel objet FomData
        let formData = new FormData();
        formData.append("nom", inputNom.value.trim());
        formData.append("prenom", inputPrenom.value.trim());
        formData.append("societe", inputSociete.value.trim());
        formData.append("email", inputMail.value.trim());
        formData.append("message", inputMessage.value.trim());

        let response = await fetch("send.php", {
            method: "POST",
            body: formData
        });

        //Conversion de la réponse en JSON
        let datas = await response.json();

        //Création clé succès
        if(!datas.success) {
            formOutput.textContent = datas.message;
            formOutput.classList.add("invalid");
            return false;
        } else {
            formOutput.textContent = datas.message;
            formOutput.classList.add("valid");
            return true;
        }

    } catch(invalid) {
        formOutput.textContent = "Erreur lors de l'envoi du mail";
        formOutput.classList.add("invalid");
        return false;
    }  
}

//Fonction permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const messageOk = validateRequired(inputMessage);

    if(nomOk && prenomOk && mailOk && messageOk){
        btnValidation.disabled = false; //Débloque le bouton d'envoi du formulaire
        formOutput.textContent = "";
        ajaxSend(e);
    }
    else{
        btnValidation.disabled = true; //bloque le bouton d'envoi du formulaire
    }
}

function validateRequired(input){
    if(input.value != ''){
        input.classList.add("valid");
        input.classList.remove("invalid");
        return true; 
    }
    else{
        formOutput.textContent = "Merci de remplir les champs manquants";
        input.classList.remove("valid");
        input.classList.add("invalid");
        return false;
    }
}

//Définir mon regex Email
function validateMail(input){       
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mailValue = input.value;

    if(mailValue.match(emailRegex)){
        input.classList.add("valid");
        input.classList.remove("invalid"); 
        formOutput.textContent = ""; //Effacer message erreur email
        return true;
    }
    else{
        formOutput.textContent = "Votre adresse email est incorecte !";
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
        document.getElementById("societe").removeAttribute("required",""); 
    } 
    else{
        document.getElementById("prof").style.display ="null";
    }
}
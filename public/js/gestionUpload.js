//on récupère le bouton de chargement
const btnCharger=document.getElementById("chargeAvatar");
btnCharger.addEventListener("click", lanceParcourir,false);

//on récupère le champ d'upload
const fileUpload=document.getElementById("registration_form_avatar")
fileUpload.addEventListener("change", afficheImage,false);

//on récupère le champ img qui affiche l'image
const avatarAffichee=document.getElementById("avatarAffichee");

function lanceParcourir(){
    console.log("coucoi");
    fileUpload.click();
}

function afficheImage(){
    const imageChargee = this.files[0];
    console.log(this.files[0]);
    const urlImageChargee=URL.createObjectURL(imageChargee);
    avatarAffichee.setAttribute("src", urlImageChargee);

}

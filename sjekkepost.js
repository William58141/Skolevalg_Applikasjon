// JavaScript Document
function sjekk_usn() {
    var epost = document.getElementById('epost').value;
    var reg = new RegExp("(.)+@usn.no");
    
    if (reg.test(epost)) {
        alert("Riktig Epost adresse");
    } else {
        alert("Feil Epost adresse");
    }
}
// Denne filen er utvilket av William, sist endret 20.02.2021
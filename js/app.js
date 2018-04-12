
const bType = document.getElementById("bilett-type");
const nasjon = document.getElementById('nasjon');
const radio= document.getElementsByName('persontype');
const fornavn = document.getElementById("fornavn");
const etterNavn = document.getElementById("etternavn");
const adresse = document.getElementById("adresse");
const postnr = document.getElementById("postnr");
const poststed = document.getElementById("poststed");
const telefon = document.getElementById("telefon");
const brukerNavn = document.getElementById("brukerNavn");
const passord = document.getElementById("passord");
const bekreftPassord = document.getElementById("bekreftPassord");

radio[0].addEventListener("click",()=>{
  bType.style.display= "block";
  nasjon.style.display= "none";

});
radio[1].addEventListener("click",()=>{
  nasjon.style.display= "block";
  bType.style.display= "none";

});





function showOrHideTip(show, element) {
  if (show) {
    element.style.display = "inherit";
  } else {
    element.style.display = "none";
  }
}

function testNavn(navn){
  return /^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/.test(navn);
}

function testAdresse(adresse){
  return /^[0-9a-zA-ZæøåÆØÅ\ \.\-\,]{2,50}$/.test(adresse);
}

function testPostnr(postnr){
  return /^[0-9a-zA-ZæøåÆØÅ\ \.\-\,]{2,50}$/.test(postnr);
}



fornavn.addEventListener("input", e => {
    const text = e.target.value;
    const valid = testNavn(text);
    const showTip = text !== "" && !valid;
    const tooltip = e.target.nextElementSibling;
    showOrHideTip(showTip, tooltip);
});

etterNavn.addEventListener("input", e => {
    const text = e.target.value;
    const valid = testNavn(text);
    const showTip = text !== "" && !valid;
    const tooltip = e.target.nextElementSibling;
    showOrHideTip(showTip, tooltip);
});

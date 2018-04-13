
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

function visSkjulFeilmedling(vist, element) {
  if (vist) {
    element.style.display = "inherit";
  } else {
    element.style.display = "none";
  }
}

function testNavnElPoststed(tekst){
  return /^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/.test(tekst);
}

function testAdresse(adresse){
  return /^[0-9a-zA-ZæøåÆØÅ\ \.\-\,]{2,50}$/.test(adresse);
}

function testPostnr(postnr){
  return /^[0-9]{4}$/.test(postnr);
}

function testTelefon(telefon){
  return /^[0-9]{8}$/.test(telefon);
}

function testBrukernavn(brukerNavn) {
  return /^[a-z][a-z0-9]+$/.test(brukerNavn);
}

function testPassord(passord) {
  return /^[a-zA-z][a-zA-z0-9].*$/.test(passord);
}

function testBekreftPassord() {
  if (passord.value === bekreftPassord.value)
    return true;
  return false;

}

function produserEventListener(validering){
  return e =>{
    const tekst = e.target.value;
    const gyldig = validering(tekst);
    const visFeilmelding = tekst !== "" && !gyldig;
    const feilmeldingElement = e.target.nextElementSibling;
    visSkjulFeilmedling(visFeilmelding, feilmeldingElement);
  }
}

if (fornavn) {
  radio[0].addEventListener("click",()=>{
    bType.style.display= "block";
    nasjon.style.display= "none";

  });
  radio[1].addEventListener("click",()=>{
    nasjon.style.display= "block";
    bType.style.display= "none";
  });

fornavn.addEventListener("input", produserEventListener(testNavnElPoststed));
etterNavn.addEventListener("input", produserEventListener(testNavnElPoststed));
adresse.addEventListener("input", produserEventListener(testAdresse));
postnr.addEventListener("input", produserEventListener(testPostnr));
poststed.addEventListener("input", produserEventListener(testNavnElPoststed));
telefon.addEventListener("input", produserEventListener(testTelefon));
}
if (brukerNavn) {
brukerNavn.addEventListener("input", produserEventListener(testBrukernavn));
passord.addEventListener("input", produserEventListener(testPassord));
}

if (brukerNavn && passord && bekreftPassord) {
bekreftPassord.addEventListener("input", produserEventListener(testBekreftPassord));
}



// fornavn.addEventListener("input", e => {
//     const tekst = e.target.value;
//     const gyldig = testNavn(tekst);
//     const visFeilmelding = text !== "" && !gyldig;
//     const feilmeldingElement = e.target.nextElementSibling;
//     visSkjulFeilmedling(visFeilmelding, feilmeldingElement);
// });
//
// etterNavn.addEventListener("input", e => {
//     const tekst = e.target.value;
//     const gyldig = testNavn(tekst);
//     const visFeilmelding = text !== "" && !gyldig;
//     const feilmeldingElement = e.target.nextElementSibling;
//     visSkjulFeilmedling(visFeilmelding, feilmeldingElement);
// });

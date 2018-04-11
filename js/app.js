
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


function testFornavn(fornavn){
  var regex = /^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/;
  if (!regex.test(fornavn)){
    alert ("Navnet har feil format, skal være bokstaver eller ('.', '-' ,mellomrom)");
  }
}

function testEtternavn(etternavn){
  var regex = /^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/;
  if (!regex.test(etternavn)){
    alert ("Etternavnet har feil format, skal være bokstaver eller ('.', '-' ,mellomrom)");
  }
}

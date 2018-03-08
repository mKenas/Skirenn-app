
var bType = document.getElementById("bilett-type");
var nasjon = document.getElementById('nasjon');
var radio= document.getElementsByName('persontype');

radio[0].addEventListener("click",()=>{
  bType.style.display= "block";
  nasjon.style.display= "none";

});
radio[1].addEventListener("click",()=>{
  nasjon.style.display= "block";
  bType.style.display= "none";

});

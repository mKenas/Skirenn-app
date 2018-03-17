<?php



function validering($felter){


  $feilMeldinger = array(
    "navn" => "<p class='feil'> Navnet har feil format, skal være bokstaver eller ('.', '-' ,mellomrom).</p>",
    "etternavn" => "<p class='feil'>Etternavnet har feil format, skal være bokstaver eller ('.', '-' ,mellomrom).</p>",
    "adresse"  => "<p class='feil'>Adressen har feil format, skal inneholder bokstaver, tall og mellomrom.</p>",
    "postNum" => "<p class='feil'>PostNummer har feil format, skal være 4 siffert tall.</p>",
    "poststed" => "<p class='feil'>Poststedet har feil format, skal være bokstaver eller ('.', '-' ,mellomrom).</p>",
    "telefon" => "<p class='feil'>Telefonnummeret har feil format, skal være 8 siffer.</p>"

    );
  $regularUtrykk = array(
    "navn"=> "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "etternavn" => "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "adresse" => "/^[0-9a-zA-ZæøåÆØÅ\ \.\-\,]{2,50}$/",
    "postNum" => "/^[0-9]{4}$/",
    "poststed" => "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "telefon" => "/^[0-9]{8}$/"

  );

$feilMelding ="";
$valederingErOK = true;

foreach ($felter as $key => $verdi) {
  if (!empty($verdi) ){

    if (preg_match($regularUtrykk[$key],$verdi))
    {
    $feilMelding = "";
    }
    else {
    $feilMelding.= $feilMeldinger[$key];
    }

  }

  else $feilMelding .= "<p class='feil'> " .$key .  " må fylles ut</p>";
}

if($feilMelding != ""){
  echo "<br/>$feilMelding,";
  $valederingErOK = false;

  }

  return $valederingErOK;
  }



 ?>

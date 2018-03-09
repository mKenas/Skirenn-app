<?php

/**
 *
 */
require_once ('Person.php');
class Publikum extends Person
{

  private $bilettType;
  private $publikumPersonId;

  function getBilettType(){return $this->bilettType;}
  function getPublikumPersonId(){return $this->publikumPersonId;}
  function setBilettType($bilettType){ $this->bilettType = $bilettType;}
  function setPublikumPersonId($publikumPersonId){$this->publikumPersonId=$publikumPersonId;}
  function __construct($navn=null,$etternavn=null,$adresse=null,$postNum=null,$postSted=null,$telefon=null,$ØvelsId=null,$bilettType=null)
  {
     parent::__construct($navn,$etternavn,$adresse,$postNum,$postSted,$telefon,$ØvelsId);
     $this->bilettType = $bilettType;
  }


  function settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$ØvelsId,$bilettType){

    $db=mysqli_connect("localhost","root","","vm_ski");
    if(!$db)
    {
        die("Feil i kobling til databasen!");
    }
    $db->set_charset("utf8");
    $foresporring = "Insert into Person (Fornavn,Etternavn,Adresse,";
    $foresporring .= "PostNum,Poststed,Telefonnr,ØvelsesId)";
    $foresporring .= "Values ('$navn','$etternavn','$adresse',";
    $foresporring .= "'$postnr','$poststed','$telefon','$ØvelsId');";

    if ($db->query($foresporring) === TRUE) {
        $this->publikumPersonId=  $db->insert_id;
        $foresporring2="Insert into Publikum (BillettType, PersonId) Values('$bilettType','$this->publikumPersonId');";

        if($db->query($foresporring2) === TRUE){
        echo "<p class='velykket'>Takk for at du meldt deg på! Din registering er motatt. </p>";
        }
    }
        elseif (mysqli_affected_rows($db)==0)
          {
              echo "Feil i registrering!";
          }
          mysqli_close($db);
    }

}
 ?>

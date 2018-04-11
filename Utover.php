
<?php

include 'Tilkobling.php';

/**
 *
 */
require_once ('Person.php');
class Utover extends Person
{

  private $nasjon;
  private $utoverPersonId;
  function getNasjon(){return $this->nasjon;}
  function getUtoverPersonId(){return $this->utoverPersonId;}
  function setNasjon($nasjon){ $this->nasjon = $nasjon;}
  function setUtoverPersonId($utoverPersonId){$this->utoverPersonId=$utoverPersonId;}

  function __construct($navn=null,$etternavn=null,$adresse=null,$postNum=null,$postSted=null,$telefon=null,$ØvelsId=null,$nasjon=null)
  {
     parent::__construct($navn,$etternavn,$adresse,$postNum,$postSted,$telefon,$ØvelsId);
     $this->nasjon = $nasjon;
  }

function settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$ØvelsId,$nasjon){

  $foresporring = "Insert into Person (Fornavn,Etternavn,Adresse,";
  $foresporring .= "PostNum,Poststed,Telefonnr,ØvelsesId)";
  $foresporring .= "Values ('$navn','$etternavn','$adresse',";
  $foresporring .= "'$postnr','$poststed','$telefon','$ØvelsId');";
  global $db;
  if ( $db->query($foresporring) === TRUE) {
      $this->utoverPersonId=  $db->insert_id;
      $foresporring2="Insert into Utøver (Nasjonalitet, PersonId) Values('$nasjon','$this->utoverPersonId');";

      if($db->query($foresporring2) === TRUE){
      echo "<p class='velykket'>Takk for at du meldt deg på! Din registering er motatt. </p>";
      }
  }
      elseif (mysqli_affected_rows($db)==0)
        {
            echo "Feil i registrering!";
        }
 }

}
 ?>

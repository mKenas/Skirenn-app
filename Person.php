<?php

include 'Tilkobling.php';

/**
 *
 */
class Person
{
    private $personId;
    private $navn;
    private $etternavn;
    private $adresse;
    private $postNum;
    private $postSted;
    private $telefon;
    private $ØvelsId;





    function getNavn(){ return $this->navn;}
    function getEtternavn(){return $this->etternavn;}
    function getAdresse(){return $this->adresse;}
    function getPostNum(){return $this->postNum;}
    function getPostSted(){return $this->postSted;}
    function getTelefon(){return $this->telefon;}
    function getØvelsId(){return $this->ØvelsId;}
    function getPersonId(){return $this->personId;}






    function setNavn($navn){ $this->$navn = $navn;}
    function setEtternavn($etternavn){$this->$etternavn =$etternavn;}
    function setAdresse($adresse){$this->adresse =$adresse;}
    function setPostNum($postNum){$this->postNum =$postNum;}
    function setPostSted($postSted){$this->postSted =$postSted;}
    function setTelefon($telefon){$this->telefon =$telefon;}

    function setØvelsId($ØvelsId){$this->ØvelsId=$ØvelsId;}



    function __construct($navn=null,$etternavn=null,$adresse=null,$postNum=null,$postSted=null,$telefon=null,$ØvelsId=null)
    {
      $this->navn = $navn;
      $this->etternavn =$etternavn;
      $this->adresse =$adresse;
      $this->postNum =$postNum;
      $this->postSted =$postSted;
      $this->telefon =$telefon;
      $this->ØvelsId=$ØvelsId;

    }

}






 ?>

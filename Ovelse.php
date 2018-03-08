<?php

require_once ('Person.php');
require_once ('Utover.php');
require_once ('Publikum.php');
class Ovelse extends Person
{

private $dato;
private $type;
private $sted;

function getDato(){return $this->$dato;}
function getType(){return $this->$type;}
function getSted(){return $this->$sted;}

function setDato($dato){ $this->dato=$dato;}
function setType($type){ $this->type=$type;}
function setSted($sted){ $this->sted=$sted;}



}

 ?>

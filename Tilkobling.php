<?php

$db =  new mysqli("localhost","root","","vm_ski");
if(!$db)
{
    die("Feil i kobling til databasen!");
}
else
{
$db->set_charset("utf8");

}
 ?>

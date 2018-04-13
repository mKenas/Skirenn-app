<?php
session_start();
include "Tilkobling.php";
include 'Validering.php';

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <link rel="stylesheet" href="css/app.css">
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>

     <div class="topnav">
        <a class="active" href="index.php">Tilbake</a>
        <div class="registert">
          <a href="Logg_inn.php">Logg inn</a>
        </div>
      </div>
     <form class="myform" action="" method="post">
        <p class="element">
         <label for="bruker">Brukernavn</label>
         <input type="text" name="brukerNavn" value="" id="brukerNavn"size="45">
         <span class = 'validering'>Brukernavnet skal begynne med et bokstav og kan innholde bokstaver og tall.</span>
        </p>
        <p class="element">
         <label for="passord">Passord</label>
         <input type="password" name="passord" value="" id="passord"size="45">
         <span class = 'validering'>Passordet skal begynne med et bokstav og kan innholde små og store bokstaver og tall.</span>
        </p>
        <p class="element">
         <label for="bekreft-passord">Bekreft passord</label>
         <input type="password" name="bekreft-passord" value="" id="bekreftPassord"size="45">
         <span class = 'validering'>Passordet samsvarer ikke! Prøv igjen.</span>
       </p>
       <input type="submit" name="register" value="Register">

       <?php

        if (isset($_REQUEST['register']))
        {
          $erRegistert = false;
          $bruker=$_REQUEST["brukerNavn"];
          $passord=$_REQUEST["passord"];
          $bekreftPassord= $_REQUEST["bekreft-passord"];
          $felter= array(
            "brukerNavn"=> $bruker,
            "passord" => $passord
          );

          if(validering($felter)){
          if ($passord === $bekreftPassord)
          {
          $foresporring = "SELECT BrukerNavn FROM Bruker;";
          $res= $db->query($foresporring);
          if ($res->num_rows >0)
          {
        while($rad= $res->fetch_assoc())
        {
           if ($rad["BrukerNavn"] === $bruker)
           {
              echo  "<p class='feil'>Brukeren finnes allerede! Prøv igjen. </p>";
              $erRegistert = true;
            }
        }
        }

        if(!$erRegistert) {
      $foresporring2= "INSERT INTO Bruker (BrukerId,BrukerNavn,Passord) values ";
      $foresporring2 .= "(NULL, '" . $bruker ."',SHA('" .$passord ."'));";
      if ($db->query($foresporring2))
      {
       echo "<p class='velykket'>Brukeren er registeret! Logg inn side åpens automatisk. </p>";
       header("Refresh:3; URL= Logg_inn.php");

       }
      else echo "<p class='feil'>Brukeren ble ikke registeret! Prøv igjen. </p>";

        }
        }
    else  echo "<p class='feil'>Passordet samsvarer ikke! Prøv igjen.</p>";

  }
  }
        ?>
     </form>
    <script src="js/index.js"></script>
   </body>
 </html>

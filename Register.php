<?php
session_start();
include "Tilkobling.php";
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
       <label for="bruker">Brukernavn</label>
       <input type="text" name="bruker" value="" id="brukerNavn">
       <label for="passord">Passord</label>
       <input type="password" name="passord-input" value="" id="passord">
       <label for="bekreft-passord">Bekreft passord</label>
       <input type="password" name="bekreft-passord" value="" id="bekreftPassord">
       <input type="submit" name="register" value="Register">

       <?php

        if (isset($_REQUEST['register']))
        {
          $erRegistert = false;
          $bruker=$_REQUEST["bruker"];
          $passord=$_REQUEST["passord"];
          $bekreftPassord= $_REQUEST["bekreft-passord"];
          if ($passord === $bekreftPassord)
          {
          $foresporring = "SELECT BrukerNavn FROM Bruker;";
          $res= $db->query($foresporring);
          if ($res->num_rows >0){
        while($rad= $res->fetch_assoc())
        {

           if ($rad["BrukerNavn"] === $bruker){
              echo  "<p class='feil'>Brukeren finnes allerede! Prøv igjen. </p>";
              $erRegistert = true;
            }
        }
        }
        if (!$erRegistert) {
      $foresporring2= "INSERT INTO Bruker (BrukerId,BrukerNavn,Passord) values ";
      $foresporring2 .= "(NULL, '" . $bruker ."',SHA('" .$passord ."'));";
      if ($db->query($foresporring2))
      {
       echo "<p class='velykket'>Brukeren er registeret! Logg inn side åpens automatisk. </p>";
       header("Refresh:3; URL= Logg_inn.php");

       }
      else{
        echo "<p class='feil'>Brukeren er ikke registeret! Prøv igjen. </p>";
      }

        }
    }

    else {

      echo "<p class='feil'>Passord er ikke samme! Prøv igjen.</p>";
    }

    }

        ?>
     </form>
   </body>
 </html>

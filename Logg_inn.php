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
          <a href="Register.php">Register</a>
        </div>
      </div>

     <form class="myform" action="" method="post">
       <p class="element">
         <label for="bruker">Brukernavn</label><br>
         <input id="brukerNavn" type="text" name="brukerNavn" value="" size="45">
         <span class = 'validering'>Brukernavnet skal begynne med et bokstav og kan innholde bokstaver og tall.</span>
       </p>
       <p class="element">
         <label for="passord">Passord</label><br>
         <input id="passord" type="password" name="passord" value=""size="45">
         <span class = 'validering'>Passordet skal begynne med et bokstav og kan innholde små og store bokstaver og tall.</span>
       </p>
       <input type="submit" name="logg-inn" value="Logg inn">
       <?php


       if (isset($_REQUEST["logg-inn"]))
       {
         $brukerNavn=$_REQUEST['brukerNavn'];
         $passord= $_REQUEST['passord'];
         $felter= array(
           "brukerNavn"=> $brukerNavn,
           "passord" => $passord
         );

           if(validering($felter)){
         $foresporring= "select BrukerID ,BrukerNavn ,Passord from Bruker where BrukerNavn ='";
         $foresporring .= "$brukerNavn" ."' And Passord=SHA('" . $passord . "');";
         $res=$db->query($foresporring);
         if ($res->num_rows >0){
          $rad =$res->fetch_assoc();
          $_SESSION["brukerNavn"] = $rad["BrukerNavn"];
          $_SESSION["erInnlogget"] = true;
          header("Location: index.php");
       }
       else echo "<p class='feil'>Brukernavn eller passord er feil! Prøv igjen. </p>";
     }
}
        ?>

     </form>
     <script src="js/index.js"></script>
   </body>
 </html>

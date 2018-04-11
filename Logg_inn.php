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
          <a href="Register.php">Register</a>
        </div>
      </div>

     <form class="myform" action="" method="post">
       <label for="bruker">Brukernavn</label>
       <input type="text" name="bruker" value="">

       <label for="passord">Passord</label>
       <input type="password" name="passord" value="">

       <input type="submit" name="logg-inn" value="Logg inn">
       <?php


       if (isset($_REQUEST["logg-inn"]))
       {
         $userNavn=$_REQUEST['bruker'];
         $passord= $_REQUEST['passord'];
         $foresporring= "select BrukerID ,BrukerNavn ,Passord from Bruker where BrukerNavn ='";
         $foresporring .= "$userNavn" ."' And Passord=SHA('" . $passord . "');";
         $res=$db->query($foresporring);
         if ($res->num_rows >0){
          $rad =$res->fetch_assoc();

          $_SESSION["Bruker"] = $rad["BrukerNavn"];
          $_SESSION["erInnlogget"] = true;

          header("Location: index.php");


       }
       else echo "<p class='feil'>Brukernavn eller passord er feil! Prøv igjen. </p>";
     }

        ?>

     </form>
   </body>
 </html>

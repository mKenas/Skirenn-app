
 <!DOCTYPE html>
 <?php
  include 'Person.php';
  include 'Utover.php';
  include 'Publikum.php';
  session_start();
  ini_set('default_charset', 'utf-8');
  $feilMeldinger = array(
    "navn" => "<p class='feil'> Navnet har feil format, skal være bokstaver eller '.', '-' eller ' '.</p>",
    "etternavn" => "<p class='feil'>Etternavnet har feil format, skal være bokstaver eller '.', '-' eller ' '.</p>",
    "adresse"  => "<p class='feil'>Adressen har feil format, skal inneholder bokstaver, tall og mellomrom.</p>",
    "postNum" => "<p class='feil'>PostNummer har feil format, skal være 4 siffert tall.</p>",
    "poststed" => "<p class='feil'>Poststedet har feil format, skal være bokstaver eller '.', '-' eller ' '.</p>",
    "telefon" => "<p class='feil'>elefonnummeret har feil format, skal være 8 siffer.</p>"

    );
  $regularUtrykk = array(
    "navn"=> "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "etternavn" => "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "adresse" => "/^[0-9a-zA-ZæøåÆØÅ\ \.\-\,]{2,50}$/",
    "postNum" => "/^[0-9]{4}$/",
    "poststed" => "/^[a-zA-ZæøåÆØÅ\ \.\-]{2,50}$/",
    "telefon" => "/^[0-9]{8}$/"

  );


  ?>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/app.css">
     <title>Skirenn Registeret</title>
     <div class="topnav">
        <a class="active" href="index.php">Registering</a>
        <a href="vis_publikum.php">Vis Publikum</a>
        <a href="vis_utover.php">Vis Utøvere</a>
        <a href="vis_ovelse.php">Øvelser</a>
      </div>
   </head>
   <body>
     <h2>Skirenn Registeret</h2>

     <form class="myform" action="" method="post">
       <label for="fornavn">Fornavn</label>
       <input type="text" name="fornavn" value="">

       <label for="etternavn">Etternavn</label>
       <input type="text" name="etternavn" value="">
       <div class="person-type">
         <label for="">Jeg er: </label>
         <label for="">Publikum</label>
         <input type="radio" name="persontype" value="Publikum" id="radio1"checked >
          <label for="">Utøver</label>
         <input type="radio" name="persontype" value="Utøver" id="radio2">
       </div>

        <div id="bilett-type">
         <label for="">Bilett type </label>
         <select name="bilettType">
          <option value="vip">VIP</option>
          <option value="voksen">Voksen</option>
          <option value="barn">Barn</option>
          </select>
        </div>

        <div id="nasjon">
          <label for="">Nasjonalitet </label>
          <select  name="nasjonaliteten">
            <option value="norge">Norge</option>
            <option value="sverige">Sverige</option>
            <option value="danmark">Danmark</option>
           </select>
        </div>
       <label for="adresse">Adresse</label>
       <input type="text" name="adresse" value="">

       <label for="postnr">PostNr</label>
       <input type="text" name="postnr" value="">

       <label for="poststed">Poststed</label>
       <input type="text" name="poststed" value="">

       <label for="telefon">Telefon</label>
       <input type="text" name="telefon" value="">

       <div id="type-øvelse">

          <label for="">Øvelses Informasjon </label>
          <select  name="ovelseInfo">
            <?php

             $db=mysqli_connect("localhost","root","","vm_ski");
             if(!$db)
             {
                 die("Feil i kobling til databasen!");
             }


             $db->set_charset("utf8");
             $foresporring= "select Type ,Sted,Dato from Øvels;";
             $res=$db->query($foresporring);
             if ($res->num_rows >0){
               while ($rad =$res->fetch_assoc()) {

                 echo "<option>" . $rad['Type'] ." - ". $rad['Sted'] ." - ". $rad['Dato'] . "</option>";
               }
             }

             mysqli_close($db);


             ?>

          </select>

         </div>






       <input type="submit" name="register" value="Register">
       <?php
         $feilMelding ="";
         $valederingErOK = true;

       if(isset($_REQUEST["register"]))
        {
          $felter= array(
            "navn"=> $_REQUEST["fornavn"],
            "etternavn" => $_REQUEST["etternavn"],
            "adresse" => $_REQUEST["adresse"],
            "postNum" => $_REQUEST["postnr"],
            "poststed" => $_REQUEST["poststed"],
            "telefon" => $_REQUEST["telefon"]
          );


            foreach ($felter as $key => $verdi) {
              if (!empty($verdi)){

                $feilMelding.= preg_match($regularUtrykk[$key],$verdi) ? "" : $feilMeldinger[$key];

              }
            }

            if($feilMelding != ""){
              echo "<br/>$feilMelding,";
              $valederingErOK = false;

              }

            if($valederingErOK){

                if ($_REQUEST["persontype"]=="Utøver"){
                  $utover = new Utover($_REQUEST["fornavn"],$_REQUEST["etternavn"],
                                       $_REQUEST["adresse"],$_REQUEST["postnr"],
                                       $_REQUEST["poststed"],$_REQUEST["telefon"],$_REQUEST["ovelseInfo"],$_REQUEST["nasjonaliteten"]);

                    $navn=$utover->getNavn();
                    $etternavn=$utover->getEtternavn();
                    $adresse=$utover->getAdresse();
                    $postnr=$utover->getPostNum();
                    $poststed=$utover->getPostSted();
                    $telefon=$utover->getTelefon();
                    $nasjinalitet=$utover->getNasjon();
                    $øvelsesInfo = $utover->getØvelsesInfo();
                    $utover->settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$øvelsesInfo,$nasjinalitet);

                  }

                else{
                  $publikum = new Publikum($_REQUEST["fornavn"],$_REQUEST["etternavn"],
                                         $_REQUEST["adresse"],$_REQUEST["postnr"],
                                         $_REQUEST["poststed"],$_REQUEST["telefon"],$_REQUEST["ovelseInfo"],$_REQUEST["bilettType"]);


                   $navn=$publikum->getNavn();
                   $etternavn=$publikum->getEtternavn();
                   $adresse=$publikum->getAdresse();
                   $postnr=$publikum->getPostNum();
                   $poststed=$publikum->getPostSted();
                   $telefon=$publikum->getTelefon();
                   $bilettType=$publikum->getBilettType();
                   $øvelsesInfo = $publikum->getØvelsesInfo();
                   $publikum->settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$øvelsesInfo,$bilettType);

                    }
                }
              }
        ?>

     </form>

    <script src="js/app.js"></script>
   </body>
 </html>
